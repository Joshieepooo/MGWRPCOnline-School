<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {

    @include 'con_db.php';

    // Retrieve and sanitize input values
    $product_products_id = mysqli_real_escape_string($conn, $_POST['product_products_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_unit_price = mysqli_real_escape_string($conn, $_POST['product_unit_price']);
    $product_total_units = intval($_POST['product_total_units']);

    // Check if the product ID already exists in the inventory table
    $check_sql = "SELECT COUNT(*) AS count FROM inventory WHERE products_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $product_products_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $check_row = $check_result->fetch_assoc();

    if ($check_row['count'] > 0) {
        echo "<script>alert('Error: A product with the same ID already exists.'); window.location.href='../admin-inventory.php';</script>";
    } else {
        // Check if the product name already exists in the inventory table
        $check_sql = "SELECT COUNT(*) AS count FROM inventory WHERE products_name = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $product_name);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        $check_row = $check_result->fetch_assoc();

        if ($check_row['count'] > 0) {
            echo "<script>alert('Error: A product with the same name already exists.'); window.location.href='../admin-inventory.php';</script>";
        } else {
            // Handle the image file upload
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
                $file_tmp = $_FILES['product_image']['tmp_name'];
                $file_contents = file_get_contents($file_tmp);
                $product_image = base64_encode($file_contents);
            } else {
                $product_image = null;
            }

            // Prepare and bind for inserting into inv_confirm
            $stmt = $conn->prepare("INSERT INTO inv_confirm
            (products_id,
            products_name,
            image,
            unit_price,
            total_units,
            reserved_units,
            stat)
            VALUES (?,?,?,?,?, 0, 'ADD')");

            // Check if prepare() failed
            if (!$stmt) {
                die("Prepare failed: ". $conn->error);
            }

            $stmt->bind_param("sssdi",
            $product_products_id,
            $product_name,
            $product_image,
            $product_unit_price,
            $product_total_units);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('Wait for the Manager to confirm your request.'); window.location.href='../admin-inventory.php';</script>";
                exit();
            } else {
                echo "Error: ". $stmt->error;
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close check statement and connection
    $check_stmt->close();
    $conn->close();
}
?>
