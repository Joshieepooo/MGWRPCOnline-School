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

        $sql = "DELETE FROM admin_contact_us WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Feedback deleted successfully";
        } else {
            echo "Error deleting feedback: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "No ID provided";
    }
?>