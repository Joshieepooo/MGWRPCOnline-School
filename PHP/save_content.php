<?php
include 'con_db.php';

$compinf = ""; // Initialize with default value

// Check if the database connection is established
if ($conn) {
    // Retrieve about_us data
    $sql = "SELECT * FROM cms_about_us WHERE ID = 1";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $abt = "data:image;base64," . base64_encode($row['image']);
            $compinf = nl2br($row['company_info']); // Apply nl2br to company info
        }
    }

    // Update company info if new data is inserted
    if (isset($_POST['saveButton'])) {
        // Check if the form field is set and not empty
        if (isset($_POST['company_info'])) {
            $company_info = htmlspecialchars($conn->real_escape_string($_POST['company_info']));

            // Ensure company_info does not exceed 1000 characters
            if (strlen($company_info) > 1000) {
                echo "Error: Company info must be 1000 characters or less.";
            } else {
                // Update company info in the database
                $sql = "UPDATE cms_about_us SET company_info='$company_info' WHERE id=1";
                if ($conn->query($sql) === TRUE) {
                    echo "Company info updated successfully.";
                    echo '<meta http-equiv="refresh" content="0">';
                } else {
                    echo "Error updating company info: " . $conn->error;
                }
            }
        }

        // Handle photo upload as part of the save operation
        if (isset($_FILES['ABTPHOTO']) && $_FILES['ABTPHOTO']['error'] == UPLOAD_ERR_OK) {
            $photo = $_FILES['ABTPHOTO']['tmp_name'];
            $photoData = addslashes(file_get_contents($photo));

            // Update profile photo in the database
            $sql = "UPDATE cms_about_us SET image = '$photoData' WHERE ID = 1";
            if ($conn->query($sql) === TRUE) {
                echo "Profile photo updated successfully.";
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                echo "Error updating profile photo: " . $conn->error;
            }
        }
    }

    // Handle photo upload separately
    if (isset($_POST['ABTPHOTOSUB']) && !isset($_POST['saveButton'])) {
        if (isset($_FILES['ABTPHOTO']) && $_FILES['ABTPHOTO']['error'] == UPLOAD_ERR_OK) {
            $photo = $_FILES['ABTPHOTO']['tmp_name'];
            $photoData = addslashes(file_get_contents($photo));

            // Update profile photo in the database
            $sql = "UPDATE cms_about_us SET image = '$photoData' WHERE ID = 1";
            if ($conn->query($sql) === TRUE) {
                echo "Profile photo updated successfully.";
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                echo "Error updating profile photo: " . $conn->error;
            }
        }
    }
} else {
    echo "Database connection is not established!";
}
?>
