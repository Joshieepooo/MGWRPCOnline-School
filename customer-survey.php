<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
        <!---------------
               TAB
        ---------------->
        <title>MGWR PC | Survey</title>
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
            $servername = "127.0.0.1:3306";
            $username = "u952394252_mgwrpc";
            $password = "adminMgwrpc1234";
            $dbname = "u952394252_mgwrpcdtb";
    
            $conn = new mysqli($servername, $username, $password, $dbname);
    
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $conn->real_escape_string($_POST['name']);
                $email = $conn->real_escape_string($_POST['email']);
                $age = $conn->real_escape_string($_POST['age']);
                
                $option1 = $conn->real_escape_string($_POST['radio1']);
                $option2 = $conn->real_escape_string($_POST['radio2']);
                $option3 = $conn->real_escape_string($_POST['radio3']);
                $option4 = $conn->real_escape_string($_POST['radio4']);
                $option5 = $conn->real_escape_string($_POST['radio5']);
                $option6 = $conn->real_escape_string($_POST['radio6']);
                $option7 = $conn->real_escape_string($_POST['radio7']);
                $option8 = $conn->real_escape_string($_POST['radio8']);
                $option9 = $conn->real_escape_string($_POST['radio9']);
                
                $comment = $conn->real_escape_string($_POST['comment']);
            
                $sql = "INSERT INTO customer_survey_responses (name, email, age,
                experience,
                liked_feature,
                recommend,
                sensible_part,
                improvement_suggestion,
                device_impact,
                likelihood_of_return,
                likelihood_of_purchase,
                overall_performance,
                comment) 
                        VALUES ('$name', '$email', '$age',
                        '$option1',
                        '$option2',
                        '$option3',
                        '$option4',
                        '$option5',
                        '$option6',
                        '$option7',
                        '$option8',
                        '$option9',
                        '$comment')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            $conn->close();
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
            <h2 id="subheading">Help us, the Developers, in improving our skills in web developing by simply answering our questions and leaving some feedback. Thank you!</h2>
        </div>
    
        <form id="surveyForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="showSuccessModal(event)">
            <div id="content1">
                <label>Name (Optional)</label><br><br>
                <input type="text" id="name" name="name" placeholder="Enter your name" class="box"><br><br>
    
                <label>Email (Optional)</label><br><br>
                <input type="text" id="email" name="email" placeholder="Enter Your Email" class="box"><br><br>
    
                <label>Age</label><br><br>
                <input type="text" id="age" name="age" placeholder="Enter Your Age" class="box" required><br><br>
    
                <label id="head1">1. How was your experience with the MGWR PC Online website?</label><br><br>
                    <div class="radio-container">
                        <input type="radio" id="option1" name="radio1" class="radio-btn" value="Excellent" required>
                        <label for="option1" class="radio-text">Excellent</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option2" name="radio1" class="radio-btn" value="Very Good"> 
                        <label for="option2" class="radio-text">Very Good</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option3" name="radio1" class="radio-btn" value="Good">
                        <label for="option3" class="radio-text">Good</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option4" name="radio1" class="radio-btn" value="Fair">
                        <label for="option4" class="radio-text">Fair</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option5" name="radio1" class="radio-btn" value="Poor">
                        <label for="option5" class="radio-text">Poor</label>
                    </div>
    
                <label id="head1">2. What did you like most about the MGWR PC Online website?</label><br><br>
                    <div class="radio-container">
                        <input type="radio" id="option6" name="radio2" class="radio-btn larger" value="Looks & Design" required>
                        <label for="option6" class="radio-text">Looks & Design</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option7" name="radio2" class="radio-btn larger" value="Easy to Use">
                        <label for="option7" class="radio-text">Easy to Use</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option8" name="radio2" class="radio-btn larger" value="Useful Content">
                        <label for="option8" class="radio-text">Useful Content</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option9" name="radio2" class="radio-btn larger" value="Fun Features">
                        <label for="option9" class="radio-text">Fun Features</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option10" name="radio2" class="radio-btn larger" value="None">
                        <label for="option10" class="radio-text">None</label>
                    </div>
    
                <label id="head1">3. Would you recommend the MGWR PC Online website to others?</label><br><br>
                    <div class="radio-container">
                        <input type="radio" id="option11" name="radio3" class="radio-btn larger" value="Definitely" required>
                        <label for="option11" class="radio-text">Definitely</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option12" name="radio3" class="radio-btn larger" value="Probably">
                        <label for="option12" class="radio-text">Probably</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option13" name="radio3" class="radio-btn larger" value="Not Sure">
                        <label for="option13" class="radio-text">Not Sure</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option14" name="radio3" class="radio-btn larger" value="Probably Not">
                        <label for="option14" class="radio-text">Probably Not</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option15" name="radio3" class="radio-btn larger" value="Definitely Not">
                        <label for="option15" class="radio-text">Definitely Not</label>
                    </div>
                
                <label id="head1">4. What part of the MGWR PC Online website made the most sense to you?</label><br><br>
                    <div class="radio-container">
                        <input type="radio" id="option16" name="radio4" class="radio-btn larger" value="Home" required>
                        <label for="option16" class="radio-text">Home</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option17" name="radio4" class="radio-btn larger" value="About Us">
                        <label for="option17" class="radio-text">About Us</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option18" name="radio4" class="radio-btn larger" value="Pricelists">
                        <label for="option18" class="radio-text">Pricelists</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option19" name="radio4" class="radio-btn larger" value="Feedbacks">
                        <label for="option19" class="radio-text">Feedbacks</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option20" name="radio4" class="radio-btn larger" value="FAQs">
                        <label for="option20" class="radio-text">FAQs</label>
                    </div>
    
                <label id="head1">5. How can we make the MGWR PC Online website better for you?</label><br><br>
                    <div class="radio-container">
                        <input type="radio" id="option21" name="radio5" class="radio-btn larger" value="It’s PERFECT" required>
                        <label for="option21" class="radio-text">It’s PERFECT</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option22" name="radio5" class="radio-btn larger" value="Faster Loading">
                        <label for="option22" class="radio-text">Faster Loading</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option23" name="radio5" class="radio-btn larger" value="Easy to Navigate">
                        <label for="option23" class="radio-text">Easy to Navigate</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option24" name="radio5" class="radio-btn larger" value="More Interesting Stuff">
                        <label for="option24" class="radio-text">More Interesting Stuff</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option25" name="radio5" class="radio-btn larger" value="Instructive">
                        <label for="option25" class="radio-text">Instructive</label>
                    </div>
                    
                <label id="head1">6. Does the kind of device you have affect how well you use the MGWR PC Online website?</label><br><br>
                    <div class="radio-container">
                        <input type="radio" id="option26" name="radio6" class="radio-btn larger" value="Helps a Lot" required>
                        <label for="option26" class="radio-text">Helps a Lot</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option27" name="radio6" class="radio-btn larger" value="Makes it a bit harder">
                        <label for="option27" class="radio-text">Makes it a bit harder</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option28" name="radio6" class="radio-btn larger" value="Doesn't Matter">
                        <label for="option28" class="radio-text">Doesn't Matter</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option29" name="radio6" class="radio-btn larger" value="Doesn't Apply to Me">
                        <label for="option29" class="radio-text">Doesn't Apply to Me</label>
                    </div>
                
                <label id="head1">7. On a scale of 1 to 10, how likely are you to visit the MGWR PC Online website again in the future?</label><br><br>
                    <div class="radio-container">
                        <input type="radio" id="option30" name="radio7" class="radio-btn larger" value="1 - 3" required>
                        <label for="option30" class="radio-text">1 - 3</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option31" name="radio7" class="radio-btn larger" value="4 - 6">
                        <label for="option31" class="radio-text">4 - 6</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option32" name="radio7" class="radio-btn larger" value="7 - 9">
                        <label for="option32" class="radio-text">7 - 9</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option33" name="radio7" class="radio-btn larger" value="10">
                        <label for="option33" class="radio-text">10</label>
                    </div>
    
                <label id="head1">8. How likely are you to purchase products or services from MGWR PC Online in the future?</label><br><br>
                    <div class="radio-container">
                        <input type="radio" id="option34" name="radio8" class="radio-btn larger" value="Very likely" required>
                        <label for="option34" class="radio-text">Very likely</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option35" name="radio8" class="radio-btn larger" value="Likely">
                        <label for="option35" class="radio-text">Likely</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option36" name="radio8" class="radio-btn larger" value="Neutral">
                        <label for="option36" class="radio-text">Neutral</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option37" name="radio8" class="radio-btn larger" value="Unlikely">
                        <label for="option37" class="radio-text">Unlikely</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option38" name="radio8" class="radio-btn larger" value="Very Unlikely">
                        <label for="option38" class="radio-text">Very Unlikely</label>
                    </div>
    
                <label id="head1">9. How would you rate the overall performance of the MGWR PC Online website?</label><br><br>
                    <div class="radio-container">
                        <input type="radio" id="option39" name="radio9" class="radio-btn larger" value="Excellent" required>
                        <label for="option39" class="radio-text">Excellent</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option40" name="radio9" class="radio-btn larger" value="Good">
                        <label for="option40" class="radio-text">Good</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option41" name="radio9" class="radio-btn larger" value="Average">
                        <label for="option41" class="radio-text">Average</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option42" name="radio9" class="radio-btn larger" value="Below Average">
                        <label for="option42" class="radio-text">Below Average</label>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="option43" name="radio9" class="radio-btn larger" value="Poor">
                        <label for="option43" class="radio-text">Poor</label>
                    </div>
    
                    <label id="head2">10. Did you encounter any technical issues while using the MGWR PC Online website? If yes, please specify.</label><br><br>
                    <textarea id="comment" name="comment" placeholder="Enter your comment here..." required></textarea>
    
                <button type="submit">Submit</button>
            </div>
        </form>
    
    
    
        <!---------------
               JS
        ---------------->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("name").addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                });
    
                document.getElementById("age").addEventListener("input", function() {
                    const maxAge = 150;
                    this.value = this.value.replace(/[^0-9]/g, '');
                    if (parseInt(this.value, 10) > maxAge) {
                        this.value = maxAge;
                    }
                });
    
                document.getElementById("comment").addEventListener("input", function() {
                    const maxLength = 900;
                    if (this.value.length > maxLength) {
                        this.value = this.value.slice(0, maxLength);
                    }
                });
    
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
                            title: "Your Feedback Has Been Received Successfully!",
                            text: "Thank you!",
                            showConfirmButton: true, 
                            timer: 5000, 
                            timerProgressBar: true, 
                            allowOutsideClick: false, 
                            allowEscapeKey: false 
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "index.php";
                            } else {
                                setTimeout(function() {
                                    window.location.href = "index.php";
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
        </script>
    </body> 
</html>