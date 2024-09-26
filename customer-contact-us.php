<!---------------
       PHP
---------------->
<?php
    include 'PHP/customer-contact-us.php';
?>



<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!---------------
               TAB
        ---------------->
        <title>MGWR PC | Contact Us</title>
        <link rel="icon" href="Images/Tab Icon.png" type="image/x-icon">
        
        <!---------------
             CSS & JS
        ---------------->
        <link rel="stylesheet" href="css/mainstyle.css">
        <link rel="stylesheet" href="css/customer-contact.css">

        <!---------------
              FONTS
        ---------------->
        <script src="https://kit.fontawesome.com/aa7454d09f.js" crossorigin="anonymous"></script>

        <!---------------
              ICONS
        ---------------->
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    </head>



    <body class="contactBg">
        <!---------------
              NAVBAR
        ---------------->
        <header class="header">
            <a href="index.php"><img src="Images/MGWR PC Logo.png" alt="" class="logo"></a>

            <input type="checkbox" id="check">
            <label for="check" class="icons">
                <img src="Images/Menu.png" alt="" id="menu-icon">
                <img src="Images/MenuX.png" alt="" id="close-icon">
            </label>

            <nav class="navbar">
                <a href="index.php" style="--i:0">Home</a>
                <a href="customer-aboutus.php" style="--i:1">About Us</a>
                <a href="customer-pricelist.html" style="--i:2">Pricelist</a> 
                <a href="customer-feedback.php" style="--i:3">Feedbacks</a>
                <a href="customer-faqs.php" style="--i:4">FAQs</a> 
            </nav>
        </header>        


        
        <!---------------
          CONTACT FORM
        ---------------->
        <section class="contact-form">
            <h1 class="heading">Get In Touch!</h1>
            <p class="sentence1">We're here to help! Reach out to us with any inquiries or feedback you may have.</p>
            <div class="contactForm">
                
                <form class="cForm" method="POST">
                    <h1 class="sub-heading">Need Support!</h1>
                    <p class="sentence1 senleft">You Have Any Questions? Problems? Tell Us!</p>
                    <input type="text" class="input" id="name" name="name" placeholder="Your name" required>
                    <input type="text" class="input" id="email" name="email" placeholder="Your email" required>
                    <input type="text" class="input" id="subject" name="subject" placeholder="Your subject" required>
                    <textarea class="input" id="message" name="message" cols="30" rows="5" placeholder="Your message..." required></textarea>
                    <input type="submit" class="inputbtn submitbtn" value="Send Message">
                </form>

                <!---------------
                   RESTRICTIONS
                ---------------->
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.getElementById("name").addEventListener("input", function() {
                            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                        });

                        document.getElementById("email").addEventListener("input", function() {
                            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailPattern.test(this.value)) {
                                this.setCustomValidity("Please enter a valid email address.");
                            } else {
                                this.setCustomValidity("");
                            }
                        });
                    });
                </script>

                <!---------------
                       MAP
                ---------------->
                <div class="map-container">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/d/embed?mid=1mUUmyxGucfWrvwh3zchU5NWZ8jUoRJ0&ehbc=2E312F" width="640" height="480"></iframe>
                    </div>
                </div>
            </div>
                
            <div class="contactMethod">
                <div class="method">
                    <i class="fa-solid fa-location-dot contactIcon"></i>
                    <article class="text">
                        <h1 class="sub-heading">Location</h1>
                        <p class="sentence2">206 Governors Drive Biñan City Laguna</p>
                    </article>
                </div>
        
                <div class="method">
                    <i class="fa-solid fa-envelope contactIcon"></i>
                    <article class="text">
                        <h1 class="sub-heading">Email</h1>
                        <p class="sentence2">Email: mgwr.cp.accs@gmail.com</p>
                    </article>
                </div>
        
                <div class="method">
                    <i class="fa-solid fa-phone contactIcon"></i>
                    <article class="text">
                        <h1 class="sub-heading">Phone</h1>
                        <p class="sentence2">+49 5401 581</p>
                    </article>
                </div>
            </div>
        </section>



        <!---------------
              FOOTER
        ---------------->
        <footer class="footer">
            <div class="footer-content">
                <span class="logo2">MGWR PC</span>
                <p>Committed in providing you with the best Computer parts and accessories, with a focus on product quality, best service, and real-time assistance.</p>
            </div>
    
            <div class="footer-content">
                <h4>Company</h4>
                <ul>                        
                    <li><a href="customer-contact-us.php">Contact Us</a></li>
                    <li><a href="customer-faqs.php">FAQs</a></li>
                    <li><a href="customer-survey.php">Survey</a></li>
                </ul>
            </div>
                
            <div class="footer-content">
                <h4>Help</h4>
                <ul>
                    <li><a href="customer-privacy.html">Privacy Policy</a></li>                
                    <li><a href="customer-terms.html">Terms of Service</a></li>
                </ul>
            </div>
    
            <div class="footer-content">
                <h4>Connect With Us</h4>
                <div class="icons2">
                    <a href="https://www.facebook.com/mgwrpc"><img src="Images/fbicon.png" alt=""></a>
                    <a href="https://www.instagram.com/mgwrpc"><img src="Images/igicon.png" alt=""></a>
                    <a href="https://www.tiktok.com/@mgwrpctrading"><img src="Images/tticon.png" alt=""></a>
                </div>
            </div>
        </footer>
    
        <!---------------
           COPYRIGHTS
        ---------------->
        <div class="copyrights">
            <p>Copyrights 2024 <span>MGWR PC</span> All Rights Reserved</p>
        </div>
    </body>
</html>
