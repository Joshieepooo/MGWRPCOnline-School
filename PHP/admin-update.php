<?php

@include 'admin-config.php';

if (isset($_POST['update_product'])) {
    $product_id = $_POST['id'];
    $product_products_id = mysqli_real_escape_string($conn, $_POST['product_products_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_image = $_FILES['product_image']['tmp_name'];
    $product_image_size = $_FILES['product_image']['size'];
    $product_total_units = intval($_POST['product_total_units']);
    $product_reserved_units = intval($_POST['product_reserved_units']);
    $product_unit_price = mysqli_real_escape_string($conn, $_POST['product_unit_price']);

    // Check if the product ID exists in the inventory table
    $check_sql = "SELECT COUNT(*) AS count FROM inventory WHERE products_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $product_products_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $check_row = $check_result->fetch_assoc();

    if ($check_row['count'] == 0) {
        echo "<script>alert('Error: Product with this ID does not exist.'); window.location.href='admin-inventory.php';</script>";
    } else {
        // Check if the product name exists in the inventory table
        $check_sql = "SELECT COUNT(*) AS count FROM inventory WHERE products_name = ? AND id != ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("si", $product_name, $product_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        $check_row = $check_result->fetch_assoc();

        if ($check_row['count'] > 0) {
            echo "<script>alert('Error: A product with the same name already exists.'); window.location.href='admin-inventory.php';</script>";
        } else {
            // Handle the image file upload
            if (isset($_FILES['product_image']) && is_uploaded_file($_FILES['product_image']['tmp_name'])) {
                $imgContent = addslashes(file_get_contents($_FILES['product_image']['tmp_name']));

                // Update SQL query with image data and ID
                $update_data = "INSERT INTO inv_confirm (id, products_id, products_name, image, total_units, reserved_units, unit_price, stat)
                                VALUES ('$product_id', '$product_products_id', '$product_name', '$imgContent', '$product_total_units', '$product_reserved_units', '$product_unit_price', 'UPDATE')";
            } else {
                // Update SQL query without image data and with ID
                $update_data = "INSERT INTO inv_confirm (id, products_id, products_name, total_units, reserved_units, unit_price, stat)
                                VALUES ('$product_id', '$product_products_id', '$product_name', '$product_total_units', '$product_reserved_units', '$product_unit_price', 'UPDATE')";
            }

            // Execute the insert query into inv_confirm
            $upload = mysqli_query($conn, $update_data);

            if ($upload) {
                echo "<script>alert('Wait for the Manager to confirm your request.'); window.location.href='admin-inventory.php';</script>";
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }

    // Close check statement and connection
    $check_stmt->close();
    $conn->close();
}

?>
