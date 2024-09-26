<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!---------------
               TAB
        ---------------->
        <title>MGWR PC | Item Review</title>
        <link rel="icon" href="Images/Tab Icon.png" type="image/x-icon">
        
        <!---------------
             CSS & JS
        ---------------->
        <link rel="stylesheet" href="css/customer-survey.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
        <!---------------
              PHP
        ---------------->
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $servername = "127.0.0.1:3306";
                $username = "u952394252_mgwrpc";
                $password = "adminMgwrpc1234";
                $dbname = "u952394252_mgwrpcdtb";
    
                $conn = new mysqli($servername, $username, $password, $dbname);
    
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
    
                $stmt = $conn->prepare("INSERT INTO customer_product_reviews (
                    name,
                    comment,
                    rating,
                    first_time_buyer,
                    regular_customer,
                    budget_shopper,
                    brand_loyalist,
                    gift_shopper,
                    window_shopper) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    
                $stmt->bind_param("sssssssss",
                    $name,
                    $comment,
                    $rating,
                    $first_time_buyer,
                    $regular_customer,
                    $budget_shopper,
                    $brand_loyalist,
                    $gift_shopper,
                    $window_shopper);
    
                $name = $_POST['name'];
                $comment = $_POST['comment'];
                $rating = $_POST['radio1'];
                $first_time_buyer = isset($_POST['checkbox1']) ? 1 : 0;
                $regular_customer = isset($_POST['checkbox2']) ? 1 : 0;
                $budget_shopper = isset($_POST['checkbox3']) ? 1 : 0;
                $brand_loyalist = isset($_POST['checkbox4']) ? 1 : 0;
                $gift_shopper = isset($_POST['checkbox5']) ? 1 : 0;
                $window_shopper = isset($_POST['checkbox6']) ? 1 : 0;
    
                $stmt->execute();
    
                echo "New records created successfully";
    
                $stmt->close();
                $conn->close();
            }
        ?>
    
        <!---------------
              FONTS
        ---------------->
        <script src="https://kit.fontawesome.com/aa7454d09f.js" crossorigin="anonymous"></script>
    
        <!---------------
              ICONS
        ---------------->
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    </head>
    
    
    
    <body>
        <!---------------
          QUESTIONAIRES 
        ---------------->
        <div class="heading">
            <a href="index.php"><img src="Images/MGWR PC Logo.png" alt="" class="logo"></a>
            <h2 id="subheading">Your answers play a crucial role in our continuous efforts to enhance our offerings and services. Thank you for helping us serve you better!</h2>
        </div>
    
        <form id="surveyForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="showSuccessModal(event)">
            <div id="content1">
                <label>Name</label><br><br>
                <input type="text" id="name" name="name" placeholder="Enter your name" class="box" required><br><br>
    
                <label id="head2">Please leave a comment for the product:</label><br><br>
                <textarea id="comment" name="comment" placeholder="Enter your comment here..." required></textarea><br><br>
    
                <label id="head1">Please rate the product you received.</label><br><br>
                <div class="radio-container">
                    <input type="radio" id="option1" name="radio1" class="radio-btn" value="5 Star" required>
                    <label for="option1" class="radio-text">5 Star</label>
                </div>
                <div class="radio-container">
                    <input type="radio" id="option2" name="radio1" class="radio-btn" value="4 Star">
                    <label for="option2" class="radio-text">4 Star</label>
                </div>
                <div class="radio-container">
                    <input type="radio" id="option3" name="radio1" class="radio-btn" value="3 Star">
                    <label for="option3" class="radio-text">3 Star</label>
                </div>
                <div class="radio-container">
                    <input type="radio" id="option4" name="radio1" class="radio-btn" value="2 Star">
                    <label for="option4" class="radio-text">2 Star</label>
                </div>
                <div class="radio-container">
                    <input type="radio" id="option5" name="radio1" class="radio-btn" value="1 Star">
                    <label for="option5" class="radio-text">1 Star</label>
                </div>
    
                <label id="head1">Kindly indicate your customer category when visiting MGWR PC Shop:</label><br><br>
                <div class="checkbox-container">
                    <input type="checkbox" id="option6" name="checkbox1" class="checkbox-btn larger">
                    <label for="option6" class="checkbox-text">First Time Buyer</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="option7" name="checkbox2" class="checkbox-btn larger">
                    <label for="option7" class="checkbox-text">Regular Customer</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="option8" name="checkbox3" class="checkbox-btn larger">
                    <label for="option8" class="checkbox-text">Budget Shopper</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="option9" name="checkbox4" class="checkbox-btn larger">
                    <label for="option9" class="checkbox-text">Brand Loyalist</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="option11" name="checkbox5" class="checkbox-btn larger" >
                    <label for="option11" class="checkbox-text">Gift Shopper</label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="option12" name="checkbox6" class="checkbox-btn larger">
                    <label for="option12" class="checkbox-text">Window Shopper</label>
                </div>
    
                <button type="submit"><h3>Submit</h3></button>
            </div>
        </form>
    
    
    
        <!---------------
               JS
        ---------------->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("surveyForm").addEventListener("submit", function(event) {
                    event.preventDefault(); 
    
                    var formData = new FormData(this);
    
                    fetch("<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data); 
    
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Your Feedback Has Been Saved Successfully!",
                            text: "It will be showed later after the administrators review your feedback",
                            showConfirmButton: true, 
                            timer: 5000, 
                            timerProgressBar: true,
                            allowOutsideClick: false, 
                            allowEscapeKey: false 
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "customer-feedback.php"; 
                            } else {
                    
                                setTimeout(function() {
                                    window.location.href = "customer-feedback.php";
                                }, 0);
                            }
                        });
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "An error occurred",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
                });
            });
    
            document.getElementById("name").addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });
    
            document.getElementById("comment").addEventListener("input", function() {
                const maxLength = 900;
                if (this.value.length > maxLength) {
                    this.value = this.value.slice(0, maxLength);
                }
            });
        </script>
    </body>
</html>