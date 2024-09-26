<?php
session_start();

// Check if the user is logged in and the username is set in the session
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true || !isset($_SESSION['admin_username'])) {
    // Redirect to the login page if not logged in
    echo "<script>
            alert('Unidentified login credentials');
            window.location.href = 'admin-login.php';
          </script>";
    exit();
}

include 'con_db.php'; // Include your database connection file

// Use a prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT COUNT(*) FROM admin_staff_login WHERE admin_username = ?");
$stmt->bind_param("s", $_SESSION['admin_username']);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count == 0) {
    // If the username does not exist in the admin_login table, redirect to the login page
    echo "<script>
            alert('Unidentified login credentials');
            window.location.href = 'admin-login.php';
          </script>";
    session_destroy(); // Destroy the session to prevent further access
    exit();
}

// Include logout functionality after the session check
include 'PHP/admin-logout.php';


?>