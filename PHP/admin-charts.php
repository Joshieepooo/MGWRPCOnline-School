<?php
include "con_db.php";


$sql = "SELECT products_name, reserved_units FROM inventory WHERE products_id  LIKE '%SULIT PC%' ORDER BY reserved_units DESC LIMIT 5";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo json_encode([]);
}

$conn->close();

echo json_encode($data);

?>