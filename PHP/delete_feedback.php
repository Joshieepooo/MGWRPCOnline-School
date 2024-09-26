<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', '/var/log/php_errors.log');

    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);
        echo "ID: " . $id;

    $servername = "127.0.0.1:3306";
    $username = "u952394252_mgwrpc";
    $password = "adminMgwrpc1234";
    $dbname = "u952394252_mgwrpcdtb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the DELETE statement for customer_product_reviews table
        $sql_product_reviews = "DELETE FROM customer_product_reviews WHERE id = ?";
        $stmt_product_reviews = $conn->prepare($sql_product_reviews);
        $stmt_product_reviews->bind_param("i", $id);
        $stmt_product_reviews->execute();

        // Prepare and execute the DELETE statement for customer_feedbacks table
        $sql_feedbacks = "DELETE FROM customer_feedbacks WHERE id = ?";
        $stmt_feedbacks = $conn->prepare($sql_feedbacks);
        $stmt_feedbacks->bind_param("i", $id);
        $stmt_feedbacks->execute();

        if ($stmt_product_reviews->affected_rows > 0 && $stmt_feedbacks->affected_rows > 0) {
            echo "Feedback deleted successfully from both tables";
        } else {
            echo "Error deleting feedback: " . $conn->error;
        }

        $stmt_product_reviews->close();
        $stmt_feedbacks->close();
        $conn->close();
    } else {
        echo "No ID provided";
    }
?>
