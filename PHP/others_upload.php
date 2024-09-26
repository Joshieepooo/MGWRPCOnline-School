<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $servername = "127.0.0.1:3306";
    $username = "u952394252_mgwrpc";
    $password = "adminMgwrpc1234";
    $dbname = "u952394252_mgwrpcdtb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $delete_previous_query = "DELETE FROM cms_pricelist_others";
    $conn->query($delete_previous_query);

    $target_dir = "../uploads/"; 
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        echo "<script>alert('Sorry, only PDF, DOC, and DOCX files are allowed.'); window.location.href = '../admin-cms.php';</script>";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_NO_FILE) {
        echo "<script>alert('No file was uploaded.'); window.location.href = '../admin-cms.php';</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.'); window.location.href = '../admin-cms.php';</script>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO cms_pricelist_others (filename, filepath) VALUES ('". basename($_FILES["fileToUpload"]["name"]) ."', '". $target_file ."')";
            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("The file '. htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). ' has been uploaded and saved to the database."); window.location.href = "../admin-cms.php";</script>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.'); window.location.href = '../admin-cms.php';</script>";
        }
    }

    $conn->close();
}
?>
