
<?php
session_start(); // Start the session

include 'con_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the admin username and password from the form
    $admin_username = isset($_POST['admin_username']) ? $_POST['admin_username'] : '';
    $admin_password = isset($_POST['admin_password']) ? $_POST['admin_password'] : '';

    // Check if the username or password is empty
    if (empty($admin_username) || empty($admin_password)) {
        die("Invalid input data");
    }

    // Check credentials in the admin_login table
    $stmt = $conn->prepare("SELECT * FROM admin_login WHERE admin_username = ? AND admin_password = ?");
    $stmt->bind_param("ss", $admin_username, $admin_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Credentials found in admin_login, redirect to super-admin-analytics.php
        $_SESSION['admin_username'] = $admin_username;
        $_SESSION['admin_logged_in'] = true;
        echo "<script>
                window.location.href = 'super-admin-analytics.php';
              </script>";
        exit();
    }

    $stmt->close();

    // Check credentials in the admin_staff_login table
    $stmt = $conn->prepare("SELECT * FROM admin_staff_login WHERE admin_username = ? AND admin_password = ?");
    $stmt->bind_param("ss", $admin_username, $admin_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Credentials found in admin_staff_login, redirect to admin-analytics.php
        $_SESSION['admin_username'] = $admin_username;
        $_SESSION['admin_logged_in'] = true;
        echo "<script>
                window.location.href = 'admin-analytics.php';
              </script>";
        exit();
    }

    // Invalid login credentials
    echo "<script>
            alert('Invalid login credentials');
            window.location.href = 'admin-login.php';
          </script>";

    $stmt->close(); // Close the statement
    $conn->close(); // Close the connection
}
?>
