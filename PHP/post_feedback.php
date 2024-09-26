<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);

    $servername = "127.0.0.1:3306";
    $username = "u952394252_mgwrpc";
    $password = "adminMgwrpc1234";
    $dbname = "u952394252_mgwrpcdtb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the review exists in the customer_product_reviews table
    $check_query = "SELECT COUNT(*) as count FROM customer_product_reviews WHERE id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        $check_query = "SELECT COUNT(*) as count FROM customer_feedbacks WHERE id = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] == 0) {
            $query = "
                SELECT 
                    id,
                    name,
                    comment,
                    rating,
                    first_time_buyer,
                    regular_customer,
                    budget_shopper,
                    brand_loyalist,
                    gift_shopper,
                    window_shopper
                FROM customer_product_reviews
                WHERE id = ?
                ORDER BY id DESC
                LIMIT 1
            ";

            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $query = "
                INSERT INTO customer_feedbacks (
                    id,
                    name,
                    comment,
                    rating,
                    first_time_buyer,
                    regular_customer,
                    budget_shopper,
                    brand_loyalist,
                    gift_shopper,
                    window_shopper)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ";

            $stmt = $conn->prepare($query);
            $stmt->bind_param("isssssssss", $row['id'], $row['name'], $row['comment'], $row['rating'], $row['first_time_buyer'], $row['regular_customer'], $row['budget_shopper'], $row['brand_loyalist'], $row['gift_shopper'], $row['window_shopper']);

            if ($stmt->execute()) {
                echo 'success';
            } else {
                echo 'error executing statement: ' . $stmt->error;
            }
        } else {
            echo 'error: review already posted';
        }
    } else {
        echo 'error: review id does not exist';
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'error: invalid request method';
}
?> 
