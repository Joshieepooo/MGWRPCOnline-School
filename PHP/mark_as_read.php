<?php
    $servername = "127.0.0.1:3306";
    $username = "u952394252_mgwrpc";
    $password = "adminMgwrpc1234";
    $dbname = "u952394252_mgwrpcdtb";

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
    
        $sql = "UPDATE admin_contact_us SET is_read = 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            echo "Marked as read successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    
        $stmt->close();
    }
    
    $conn->close();
?>
