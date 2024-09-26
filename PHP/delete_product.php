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

          // Check if the ID exists and fetch the data
    $fetch_sql = "SELECT * FROM inventory WHERE id = ?";
    $fetch_stmt = $conn->prepare($fetch_sql);
    $fetch_stmt->bind_param("i", $id); // Bind 'id' parameter as integer
    $fetch_stmt->execute(); // Execute the prepared statement
    $result = $fetch_stmt->get_result(); // Get the result of the query

    // Check if there is a row returned
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the row data

        // Prepare SQL statement to insert data into 'inv_confirm' table
        $insert_sql = "INSERT INTO inv_confirm (id, products_id, products_name, image, total_units, reserved_units, unit_price, stat)
                       VALUES (?, ?, ?, ?, ?, ?, ?, 'DELETE')";
        $insert_stmt = $conn->prepare($insert_sql);
        
        // Bind parameters for the insert statement
        $insert_stmt->bind_param(
            "issssii",
            $id,
            $row['products_id'],
            $row['products_name'],
            $row['image'],
            $row['total_units'],
            $row['reserved_units'],
            $row['unit_price']
        );

        // Execute the insert statement
        if ($insert_stmt->execute()) {
            echo "Wait for the manager to confirm your request."; // Success message
        } else {
            echo "Error inserting data into inv_confirm: " . $conn->error; // Error message
        }

        // Close the insert statement
        $insert_stmt->close();
    } else {
        echo "Error: Product with this ID does not exist."; // Error message if no matching ID found
    }

    // Close the fetch statement
    $fetch_stmt->close();

    // Close the database connection
    $conn->close();
} else {
    echo "No ID provided."; // Error message if 'id' parameter is not set in POST request
}
?>
