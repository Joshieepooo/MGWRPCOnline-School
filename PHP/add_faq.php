<?php
    $servername = "127.0.0.1:3306";
    $username = "u952394252_mgwrpc";
    $password = "adminMgwrpc1234";
    $dbname = "u952394252_mgwrpcdtb";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $new_question = $_POST["new_question"];
    $new_answer = $_POST["new_answer"];
    
    $sql = "INSERT INTO cms_faqs (question, answer) VALUES ('$new_question', '$new_answer')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin-cms.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
?>
