<?php
session_start();
include 'con_db.php'; // Ensure the path is correct

// Function to generate a random 6-letter string
function generateRandomID($length = 6) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Retrieve the product ID from the session
if (isset($_SESSION['product_id'])) {
    $product_id = $_SESSION['product_id'];
    $sql = "SELECT * FROM inventory WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $contactNum = $_POST['contactNum'];
    $quantity = $_POST['quantity'];
    $product_name = $product['products_name'];

    // Generate a random reservation ID
    $reservationID = generateRandomID();

    // SQL query to insert the reservation details
    $sql = "INSERT INTO reservation (Prod_categ, Date, IDreservation, customer, product,email, num, reserved_units, status) 
            VALUES ('$product_id', NOW(), '$reservationID', '$firstName $lastName','$product_name', '$email', '$contactNum', '$quantity', 'Pending')";

    if (mysqli_query($conn, $sql)) {
        $successMessage = "Reservation successful!";
    } else {
        $errorMessage = "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
