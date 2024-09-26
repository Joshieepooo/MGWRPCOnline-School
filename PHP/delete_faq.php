<?php
    $servername = "127.0.0.1:3306";
    $username = "u952394252_mgwrpc";
    $password = "adminMgwrpc1234";
    $dbname = "u952394252_mgwrpcdtb";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $faqId = isset($data['id']) ? intval($data['id']) : 0;
    
    $response = [];
    if ($faqId > 0) {
        $stmt = $conn->prepare("DELETE FROM cms_faqs WHERE id = ?");
        $stmt->bind_param("i", $faqId);
    
        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = 'Execute error: ' . $stmt->error;
        }
    
        $stmt->close();
    } else {
        $response['success'] = false;
        $response['error'] = 'Invalid FAQ ID';
    }
    
    $conn->close();
    
    header('Content-Type: application/json');
    echo json_encode($response);
?>
