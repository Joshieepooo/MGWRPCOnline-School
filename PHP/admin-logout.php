<?php

if (isset($_POST['LG'])) {
session_start(); // Start the session
session_unset(); // Unset all of the session variables
session_destroy(); // Destroy the session
header("Location: admin-login.php"); // Redirect to the login page
exit();
}
?>