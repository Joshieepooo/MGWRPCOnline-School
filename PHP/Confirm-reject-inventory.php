<?php
if (isset($_POST['id']) && isset($_POST['action'])) {
    $id = intval($_POST['id']);
    $action = $_POST['action'];

    include 'admin-config.php';

    if ($action === 'confirm') {
        // Handle confirmation of product update or addition
        confirmProductAction($conn, $id);
    } elseif ($action === 'reject') {
        // Handle rejection of product update or addition request
        rejectRequest($conn, $id);
    } else {
        echo "Invalid action.";
    }

    $conn->close();
} else {
    echo "No ID or action provided.";
}

function confirmProductAction($conn, $id) {
    // Fetch the data from inv_confirm
    $sql = "SELECT * FROM inv_confirm WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stat = strtoupper($row['Stat']);

        switch ($stat) {
            case 'DELETE':
                // Delete the product from inventory where products_id matches
                $delete_sql = "DELETE FROM inventory WHERE products_id = ?";
                $delete_stmt = $conn->prepare($delete_sql);
                $delete_stmt->bind_param("s", $row['products_id']);
                if ($delete_stmt->execute()) {
                    echo "Product deletion confirmed.";
                } else {
                    echo "Error deleting product: " . $conn->error;
                }
                $delete_stmt->close();
                break;
            case 'ADD':
                // Check if products_id already exists in inventory
                $check_sql = "SELECT COUNT(*) AS count FROM inventory WHERE products_id = ?";
                $check_stmt = $conn->prepare($check_sql);
                $check_stmt->bind_param("s", $row['products_id']);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();
                $check_row = $check_result->fetch_assoc();

                if ($check_row['count'] > 0) {
                    echo "Error: Product with this ID already exists in inventory.";
                } else {
                    // Insert product into inventory
                    $insert_sql = "INSERT INTO inventory (products_id, products_name, image, total_units, reserved_units, unit_price)
                                   VALUES (?, ?, ?, ?, ?, ?)";
                    $insert_stmt = $conn->prepare($insert_sql);
                    $insert_stmt->bind_param("sssiii", $row['products_id'], $row['products_name'], $row['image'], $row['total_units'], $row['reserved_units'], $row['unit_price']);
                    if ($insert_stmt->execute()) {
                        echo "Product addition confirmed.";
                    } else {
                        echo "Error adding product: " . $conn->error;
                    }
                    $insert_stmt->close();
                }
                $check_stmt->close();
                break;
            case 'UPDATE':
                // Update product in inventory
                $update_fields = [];
                $params = [];
                $types = "";

                if (!empty($row['products_name'])) {
                    $update_fields[] = "products_name = ?";
                    $params[] = $row['products_name'];
                    $types .= "s";
                }
                if (!empty($row['image'])) {
                    $update_fields[] = "image = ?";
                    $params[] = $row['image'];
                    $types .= "s";
                }
                if (!empty($row['total_units'])) {
                    $update_fields[] = "total_units = ?";
                    $params[] = $row['total_units'];
                    $types .= "i";
                }
                if (!empty($row['reserved_units'])) {
                    $update_fields[] = "reserved_units = ?";
                    $params[] = $row['reserved_units'];
                    $types .= "i";
                }
                if (!empty($row['unit_price'])) {
                    $update_fields[] = "unit_price = ?";
                    $params[] = $row['unit_price'];
                    $types .= "i";
                }

                if (!empty($update_fields)) {
                    $update_sql = "UPDATE inventory SET " . implode(", ", $update_fields) . " WHERE products_id = ?";
                    $params[] = $row['products_id'];
                    $types .= "s";

                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bind_param($types, ...$params);

                    if ($update_stmt->execute()) {
                        echo "Product update confirmed.";
                    } else {
                        echo "Error updating product: " . $conn->error;
                    }
                    $update_stmt->close();
                } else {
                    echo "No fields to update.";
                }
                break;
            default:
                echo "Invalid action.";
                break;
        }

        // Delete the request from inv_confirm
        $delete_request_sql = "DELETE FROM inv_confirm WHERE id = ?";
        $delete_request_stmt = $conn->prepare($delete_request_sql);
        $delete_request_stmt->bind_param("i", $id);
        $delete_request_stmt->execute();
        $delete_request_stmt->close();
    } else {
        echo "Request not found.";
    }

    $stmt->close();
}

function rejectRequest($conn, $id) {
    // Delete the request from inv_confirm
    $sql = "DELETE FROM inv_confirm WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Request rejected successfully.";
    } else {
        echo "Error rejecting request: " . $conn->error;
    }

    $stmt->close();
}
?>
