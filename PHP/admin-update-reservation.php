<?php
@include 'admin-config.php';

// Function to check reservation status
function checkReservationStatus($conn, $IDreserve) {
    $sql = "SELECT status FROM reservation WHERE IDreservation=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $IDreserve);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['status'];
    }
    return false;
}

// Edit reservation status
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IDreserve = $_POST['reservation_id'];
    $Status = $_POST['status'];

    // Check if reservation exists
    $currentStatus = checkReservationStatus($conn, $IDreserve);
    if ($currentStatus !== false) {
        if ($currentStatus == 'Confirmed' && $Status == 'Confirmed') {
            echo "<script>alert('Reservation is already confirmed.');</script>";
        } elseif ($currentStatus == 'Cancelled' && $Status == 'Cancelled') {
            echo "<script>alert('Reservation is already cancelled.');</script>";
        } elseif ($currentStatus == 'Pending' && $Status == 'Confirmed') {
            confirmReservation($conn, $IDreserve);
            updateReservationStatusAndInventory($conn, $IDreserve);
        } elseif ($currentStatus == 'Pending' && $Status == 'Cancelled') {
              // Only cancel reservation if status is pending
              cancelReservation($conn, $IDreserve);
        } 
        elseif ($currentStatus == 'Confirmed' && $Status == 'Cancelled') {
            cancelReservation($conn, $IDreserve);
            updateInventoryBasedOnCancellations($conn, $IDreserve);
        }  elseif ($currentStatus == 'Cancelled' && $Status == 'Confirmed') {
            confirmReservation($conn, $IDreserve);
            updateReservationStatusAndInventory($conn, $IDreserve);
        }

        else {
            echo "<script>alert('Invalid status transition.');</script>";
        }
    } else {
        echo "<script>alert('Reservation not found.');</script>";
    }
} else {
    error_log("Missing reservation_id or status in POST data");
}

// Function to update reservation status and inventory
function updateReservationStatusAndInventory($conn, $IDreserve) {
    // Call function to update inventory based on reservations
    updateInventoryBasedOnReservations($conn, $IDreserve);

    // Additional code to handle other updates if needed...
    // For example:
    // $sql = "UPDATE ...";
    // mysqli_query($conn, $sql);
}

// Function to update inventory based on confirmed reservations for a specific reservation ID
function updateInventoryBasedOnReservations($conn, $IDreserve) {
    // Step 1: Get the reserved quantity for the specific reservation ID
    $getReservedQuantitySQL = "SELECT reserved_units, Prod_categ FROM reservation WHERE IDreservation = ? AND status = 'Confirmed'";
    $stmt = $conn->prepare($getReservedQuantitySQL);
    $stmt->bind_param("s", $IDreserve);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $reservedQuantityRow = $result->fetch_assoc();
        $reservedQuantity = $reservedQuantityRow['reserved_units'];
        $confirmedProd_categ = $reservedQuantityRow['Prod_categ'];

        // Step 2: Update the total units in the inventory by subtracting the reserved quantity
        $updateInventorySQL = "
            UPDATE inventory
            SET total_units = total_units - ?, reserved_units = reserved_units + ?
            WHERE id = ?;
        ";
        $stmt = $conn->prepare($updateInventorySQL);
        $stmt->bind_param("iis", $reservedQuantity, $reservedQuantity, $confirmedProd_categ);
        if ($stmt->execute() === TRUE) {
            echo "<script>alert('Inventory updated successfully.');</script>";
        } else {
            echo "Error updating total units in inventory: " . $conn->error;
        }
    } else {
        echo "<script>alert('No confirmed reservation found with the specified reservation Product ID.');</script>";
    }
}


// Function to confirm reservation with quantity check
function confirmReservation($conn, $IDreserve) {
    // Check if the reserved quantity exceeds the available units in inventory
    $checkQuantitySQL = "SELECT reservation.reserved_units, inventory.total_units FROM reservation JOIN inventory ON reservation.Prod_categ = inventory.id WHERE reservation.IDreservation=?";
    $stmt = $conn->prepare($checkQuantitySQL);
    $stmt->bind_param("s", $IDreserve);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $reservedQuantity = $row['reserved_units'];
        $totalUnits = $row['total_units'];

        if ($reservedQuantity <= $totalUnits) {
            // SQL update query
            $sql = "UPDATE `reservation` SET status='Confirmed' WHERE IDreservation=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $IDreserve);

            if ($stmt->execute()) {
                error_log("Reservation confirmed successfully");
                echo "<script>alert('Reservation confirmed successfully.');</script>";
            } else {
                error_log("Failed to confirm reservation: " . $conn->error);
                echo "<script>alert('Failed to confirm reservation.');</script>";
            }
        } else {
            echo "<script>alert('Insufficient quantity. Cannot confirm reservation.');</script>";
        }
    } else {
        echo "<script>alert('Reservation not found.');</script>";
    }
}


// Function to cancel reservation
function cancelReservation($conn, $IDreserve) {
    // SQL update query
    $sql = "UPDATE `reservation` SET status='Cancelled' WHERE IDreservation=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $IDreserve);

    if ($stmt->execute()) {
        
        error_log("Reservation cancelled successfully");
        echo "<script>alert('Reservation cancelled successfully.');</script>";
    } else {
        error_log("Failed to cancel reservation: " . $conn->error);
        echo "<script>alert('Failed to cancel reservation.');</script>";
    }
}

// Function to update inventory based on cancelled reservations
function updateInventoryBasedOnCancellations($conn, $IDreserve) {
    // Step 1: Fetch the reserved units for the cancelled reservation
    $fetchReservedUnitsSQL = "SELECT reserved_units, Prod_categ FROM reservation WHERE IDreservation=?";
    $stmt = $conn->prepare($fetchReservedUnitsSQL);
    $stmt->bind_param("s", $IDreserve);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $cancelledUnits = $row['reserved_units'];
    $cancelledProd_categ = $row['Prod_categ'];

    // Step 2: Update the inventory table for the specific product category
    $updateInventorySQL = "
        UPDATE inventory
        SET reserved_units = GREATEST(reserved_units - ?, 0),
            total_units = total_units + ?
        WHERE id = ?;
    ";
    $stmt = $conn->prepare($updateInventorySQL);
    $stmt->bind_param("iis", $cancelledUnits, $cancelledUnits, $cancelledProd_categ);

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Inventory updated successfully.');</script>";
    } else {
        echo "Error updating inventory: " . $conn->error;
    }
}
?>

