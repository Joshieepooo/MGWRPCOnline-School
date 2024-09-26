<?php
    $servername = "127.0.0.1:3306";
    $username = "u952394252_mgwrpc";
    $password = "adminMgwrpc1234";
    $dbname = "u952394252_mgwrpcdtb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT filepath FROM cms_pricelist_laptop";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $file_path = $row["filepath"];
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"" . basename($file_path) . "\"");
        readfile($file_path);
        exit;
    }
} else {
    echo "<script>
    alert('The Admin are currently changing the downloadable files. Please Wait.');
    window.location.href = '../customer-pricelist.html';
    </script>";
}

$conn->close();
?>
