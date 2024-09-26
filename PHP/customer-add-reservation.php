<?php

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

// Function to handle form submission
if (isset($_POST['confirmBtn'])) {
    $productID = $_POST['pname']; // Assuming 'pname' is the name attribute of the product input field in your HTML form
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $contactNumber = $_POST['contactNum'];
    $quantity = $_POST['quantity'];

    // Retrieve total units available for the product from inventory
    $stmt = $conn->prepare("SELECT total_units FROM inventory WHERE products_id = ?");
    $stmt->bind_param("s", $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalUnits = $row['total_units'];

        // Check if requested quantity is less than or equal to total units
        if ($quantity <= $totalUnits) {
            // If quantity is sufficient, proceed with reservation
            $stmt = $conn->prepare("SELECT * FROM inventory WHERE products_id = ?");
            $stmt->bind_param("s", $productID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $productName = $product['products_name'];
                $productCategory = $product['id']; // Assuming the category ID is in the 'id' column of the inventory table

                // Generate a random reservation ID
                $reservationID = generateRandomID();

                // Concatenate first name and last name
                $customer = $firstName . ' ' . $lastName;

                // Insert reservation into database
                $insertQuery = "INSERT INTO reservation (Prod_categ, Date, IDreservation, customer, product, email, num, reserved_units, status) VALUES ($productCategory, NOW(), '$reservationID', '$customer', '$productName', '$email', '$contactNumber', '$quantity', 'Pending')";

                if ($conn->query($insertQuery) === TRUE) {
                    echo "<script>alert('Reservation added successfully.'); window.location.href = 'index.php';</script>";
                } else {
                    echo "<script>alert('Failed to add reservation.'); window.location.href = 'index.php';</script>";
                }
            } else {
                echo "<script>alert('Product ID does not exist in the inventory.'); window.location.href = 'index.php';</script>";
            }
        } else {
            // If quantity is insufficient, display error message
            echo "<script>alert('Insufficient units. Total units remaining: $totalUnits'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Product ID does not exist in the inventory.'); window.location.href = 'index.php';</script>";
    }
}




// Function to handle form submission
else if (isset($_POST['confirmBtn2'])) {
    $productID = $_POST['pname2']; // Assuming 'pname2' is the name attribute of the product input field in your HTML form
    $firstName = $_POST['fname2'];
    $lastName = $_POST['lname2'];
    $email = $_POST['email2'];
    $contactNumber = $_POST['contactNum2'];
    $quantity = $_POST['quantity2'];

    // Retrieve total units available for the product from inventory
    $stmt = $conn->prepare("SELECT total_units FROM inventory WHERE products_id = ?");
    $stmt->bind_param("s", $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalUnits = $row['total_units'];

        // Check if requested quantity is less than or equal to total units
        if ($quantity <= $totalUnits) {
            // If quantity is sufficient, proceed with reservation
            $stmt = $conn->prepare("SELECT * FROM inventory WHERE products_id = ?");
            $stmt->bind_param("s", $productID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $productName = $product['products_name'];
                $productCategory = $product['id']; // Assuming the category ID is in the 'id' column of the inventory table

                // Generate a random reservation ID
                $reservationID = generateRandomID();

                // Concatenate first name and last name
                $customer = $firstName . ' ' . $lastName;

                // Insert reservation into database
                $insertQuery = "INSERT INTO reservation (Prod_categ, Date, IDreservation, customer, product, email, num, reserved_units, status) VALUES ($productCategory, NOW(), '$reservationID', '$customer', '$productName', '$email', '$contactNumber', '$quantity', 'Pending')";

                if ($conn->query($insertQuery) === TRUE) {
                    echo "<script>alert('Reservation added successfully.'); window.location.href = 'index.php';</script>";
                } else {
                    echo "<script>alert('Failed to add reservation.'); window.location.href = 'index.php';</script>";
                }
            } else {
                echo "<script>alert('Product ID does not exist in the inventory.'); window.location.href = 'index.php';</script>";
            }
        } else {
            // If quantity is insufficient, display error message
            echo "<script>alert('Insufficient units. Total units remaining: $totalUnits'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Product ID does not exist in the inventory.'); window.location.href = 'index.php';</script>";
    }
}





// Function to handle form submission
else if (isset($_POST['confirmBtn3'])) {
    $productID = $_POST['pname3']; // Assuming 'pname3' is the name attribute of the product input field in your HTML form
    $firstName = $_POST['fname3'];
    $lastName = $_POST['lname3'];
    $email = $_POST['email3'];
    $contactNumber = $_POST['contactNum3'];
    $quantity = $_POST['quantity3'];

    // Retrieve total units available for the product from inventory
    $stmt = $conn->prepare("SELECT total_units FROM inventory WHERE products_id = ?");
    $stmt->bind_param("s", $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalUnits = $row['total_units'];

        // Check if requested quantity is less than or equal to total units
        if ($quantity <= $totalUnits) {
            // If quantity is sufficient, proceed with reservation
            $stmt = $conn->prepare("SELECT * FROM inventory WHERE products_id = ?");
            $stmt->bind_param("s", $productID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $productName = $product['products_name'];
                $productCategory = $product['id']; // Assuming the category ID is in the 'id' column of the inventory table

                // Generate a random reservation ID
                $reservationID = generateRandomID();

                // Concatenate first name and last name
                $customer = $firstName . ' ' . $lastName;

                // Insert reservation into database
                $insertQuery = "INSERT INTO reservation (Prod_categ, Date, IDreservation, customer, product, email, num, reserved_units, status) VALUES ($productCategory, NOW(), '$reservationID', '$customer', '$productName', '$email', '$contactNumber', '$quantity', 'Pending')";

                if ($conn->query($insertQuery) === TRUE) {
                    echo "<script>alert('Reservation added successfully.'); window.location.href = 'index.php';</script>";
                } else {
                    echo "<script>alert('Failed to add reservation.'); window.location.href = 'index.php';</script>";
                }
            } else {
                echo "<script>alert('Product ID does not exist in the inventory.'); window.location.href = 'index.php';</script>";
            }
        } else {
            // If quantity is insufficient, display error message
            echo "<script>alert('Insufficient units. Total units remaining: $totalUnits'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Product ID does not exist in the inventory.'); window.location.href = 'index.php';</script>";
    }
}


else if (isset($_POST['confirmBtn4'])) {
    $productID = $_POST['pname4']; // Assuming 'pname4' is the name attribute of the product input field in your HTML form
    $firstName = $_POST['fname4'];
    $lastName = $_POST['lname4'];
    $email = $_POST['email4'];
    $contactNumber = $_POST['contactNum4'];
    $quantity = $_POST['quantity4'];

    // Prepare SQL statement to retrieve total units available for the product from inventory
    // Retrieve total units available for the product from inventory
    $stmt = $conn->prepare("SELECT total_units FROM inventory WHERE products_id = ?");
    $stmt->bind_param("s", $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalUnits = $row['total_units'];

        // Check if requested quantity is less than or equal to total units
        if ($quantity <= $totalUnits) {
            // If quantity is sufficient, proceed with reservation
            $stmt = $conn->prepare("SELECT * FROM inventory WHERE products_id = ?");
            $stmt->bind_param("s", $productID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $productName = $product['products_name'];
                $productCategory = $product['id']; // Assuming the category ID is in the 'id' column of the inventory table

                // Generate a random reservation ID
                $reservationID = generateRandomID();

                // Concatenate first name and last name
                $customer = $firstName . ' ' . $lastName;

                // Insert reservation into database
                $insertQuery = "INSERT INTO reservation (Prod_categ, Date, IDreservation, customer, product, email, num, reserved_units, status) VALUES ($productCategory, NOW(), '$reservationID', '$customer', '$productName', '$email', '$contactNumber', '$quantity', 'Pending')";

                if ($conn->query($insertQuery) === TRUE) {
                    echo "<script>alert('Reservation added successfully.'); window.location.href = 'index.php';</script>";
                } else {
                    echo "<script>alert('Failed to add reservation.'); window.location.href = 'index.php';</script>";
                }
            } else {
                echo "<script>alert('Product ID does not exist in the inventory.'); window.location.href = 'index.php';</script>";
            }
        } else {
            // If quantity is insufficient, display error message
            echo "<script>alert('Insufficient units. Total units remaining: $totalUnits'); window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Product ID does not exist in the inventory.'); window.location.href = 'index.php';</script>";
    }
}
?>


