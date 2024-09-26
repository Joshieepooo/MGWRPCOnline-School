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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the form
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $quantity = $_POST['quantity'];
    $productID = $_POST['product_id'];

    // Fetch product details from inventory using the provided product ID
    $sql = "SELECT * FROM inventory WHERE products_id = '$productID'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        $productName = $product['products_name'];
        $productCategory = $product['id']; // Assuming the category ID is in the 'id' column of the inventory table
        $totalUnits = $product['total_units']; // Assuming the column name for total units is 'total_units'

        if ($quantity <= $totalUnits) {
            // Generate a random reservation ID
            $reservationID = generateRandomID();

            // Placeholder for email and contact number
            $email = '---';
            $contactNumber = '---';

            // Concatenate first name and last name
            $customer = $firstName . ' ' . $lastName;

            // Insert reservation into database
            $insertQuery = "INSERT INTO reservation (Prod_categ, Date, IDreservation, customer, product, email, num, reserved_units, status) VALUES ('$productCategory', NOW(), '$reservationID', '$customer', '$productName', '$email', '$contactNumber', '$quantity', 'Pending')";
            if (mysqli_query($conn, $insertQuery)) {
                echo "<script>alert('Reservation added successfully.');</script>";
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                echo "<script>alert('Failed to add reservation.');</script>";
            }
        } else {
            echo "<script>alert('Insufficient units. Total units left: $totalUnits');</script>";
        }
    } else {
        echo "<script>alert('Product ID does not exist in the inventory.');</script>";
    }
} else {
    echo "<script>alert('Please fill in all required fields.');</script>";
}
?>
