<?php
include 'con_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO admin_contact_us (customer_name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "<script>
                alert('Message sent successfully!');
                window.location.href = window.location.href; // Refresh the page
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $stmt->error . "');
                window.location.href = window.location.href; // Refresh the page
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>
