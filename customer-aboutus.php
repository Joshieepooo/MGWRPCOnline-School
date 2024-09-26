<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!---------------
               PHP
        ---------------->
        <?php include "PHP/save_content.php"; ?>
    
        <!---------------
               TAB
        ---------------->
        <title>MGWR PC | About Us</title>
        <link rel="icon" href="Images/Tab Icon.png" type="image/x-icon">
        
        <!---------------
             CSS & JS
        ---------------->
        <link rel="stylesheet" href="css/mainstyle.css">
        <link rel="stylesheet" href="css/customer-aboutus.css">
    
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
                <a class="active" href="customer-aboutus.php" style="--i:1">About Us</a>
                <a href="customer-pricelist.html" style="--i:2">Pricelist</a> 
                <a href="customer-feedback.php" style="--i:3">Feedbacks</a>
                <a href="customer-faqs.php" style="--i:4">FAQs</a> 
            </nav>
        </header>    
    
    
    
       <!---------------
             ABOUT US
        ---------------->
      <section class="about">
            <div class="main">
            <div class="image-container">
                    <img id="previewImage" src="<?php echo $abt; ?>" alt="Company Image">
                    </div>
                <div class="all-text">
                    <h4>WHO ARE WE</h4>
                    <h1>MGWR PC</h1>
                   <p><?php echo $compinf; ?></p>
                    <div class="btn">
                        <a href="customer-contact-us.php">
                            <button type="button" class="btn2">Contact Us</button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    
    
    
        <!---------------
            M, V, CV
        ---------------->
        <section class="mvcv-container">
            <div class="mvcv-block">
                <div class="box">
                    <div class="icon">01</div>
                    <div class="content">
                        <h3>Mission</h3>
                        <p>Our mission is to provide outstanding value to our customers, employees, and business partners through our ability to deliver superior results using industry best practices.</p>
                    </div>
                </div>
        
                <div class="box">
                    <div class="icon">02</div>
                    <div class="content">
                        <h3>Vision</h3>
                        <p>Become indispensable to our customers by offering computer products and services that assist them in achieving their goals.</p>
                    </div>
                </div>
        
                <div class="box">
                    <div class="icon">03</div>
                    <div class="content">
                        <h3>Core Values</h3>
                        <p>Collaborative, Respect, Integrity, Pride.</p>
                    </div>
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
