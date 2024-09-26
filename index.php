<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!---------------
               TAB
        ---------------->
        <title>MGWR PC | Home</title>
        <link rel="icon" href="Images/Tab Icon.png" type="image/x-icon">

        <!---------------
               PHP
        ---------------->
        <?php 
            include "PHP/promotion.php";
            session_start();
            if (isset($_POST['confirmBtn']) || isset($_POST['confirmBtn2']) || isset($_POST['confirmBtn3']) || isset($_POST['confirmBtn4'])) {
            include "PHP/customer-add-reservation.php";}
        ?>

        <!---------------
            CSS & JS
        ---------------->
        <link rel="stylesheet" href="css/mainstyle.css">
        <link rel="stylesheet" href="css/customer-home.css">
        <script src="js/mainscript.js"></script>

        <!---------------
              FONTS
        ---------------->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!---------------
              ICONS
        ---------------->
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    </head>



    <body>
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
                <a class="active" href="index.php" style="--i:0">Home</a>
                <a href="customer-aboutus.php" style="--i:1">About Us</a>
                <a href="customer-pricelist.html" style="--i:2">Pricelist</a> 
                <a href="customer-feedback.php" style="--i:3">Feedbacks</a>
                <a href="customer-faqs.php" style="--i:4">FAQs</a> 
            </nav>
        </header>     



        <!---------------
            PROMOTIONS
        ---------------->
        <section class="slider-container">
            <div class="slider">
                <div class="list">
                    <div class="item">
                        <img src="<?php echo $promoImage; ?>" alt="" >
                    </div>
                    <div class="item">
                        <img src="<?php echo $promoImage2; ?>" alt="" >
                    </div>
                    <div class="item">
                        <img src="<?php echo $promoImage3; ?>" alt="" >
                    </div>
                    <div class="item">
                        <img src="<?php echo $promoImage4; ?>" alt="" >
                    </div>
                    <div class="item">
                        <img src="<?php echo $promoImage5; ?>" alt="" >
                    </div>
                </div>
                <div class="buttons">
                    <button id="prev"><</button>
                    <button id="next">></button>
                </div>
                <ul class="dots">
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
        </section>



        <!---------------
            SULIT PCS
        ---------------->
        <section class="sulitPc">
            <div class="text-center">
                <h2>SULIT PC</h2>
                <p class="sentence1">Check out our best-selling computers, designed for performance and reliability.</p>
            </div>

            <div class="sulitPcContents">
                <?php 
                    $sql = "SELECT * FROM inventory WHERE products_id  LIKE '%SULIT PC%'  ORDER BY RAND()  LIMIT 3";
                    $result = mysqli_query($conn, $sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                        
                ?>
                <div class="row">
                <img src="data:image;base64,<?php echo base64_encode($row['image']); ?>" alt="<?php echo $row['products_id']; ?>">
                    <h4><?php echo $row['products_name']; ?></h4>
                    <h5><?php echo $row['products_id']; ?></h5>
                    <h6>₱<?php echo $row['unit_price']; ?></h6>
                </div>
                <?php
                        }
                    }
                ?>
            </div>

            <div class="shortcut">
                <a class="btn-fdbck" href="customer-pricelist.html">SULIT PC Pricelists</a>
                <button class="btn-fdbck reserve1">Reserve</button>
            </div>
        </section>



        <!---------------
            PC MODAL
        ---------------->
        <div id="reservepcModal" class="modal">
            <div class="modal-content pcmodal">
                <h2>Reservation For Sulit PCs</h2>
                <form id="reserveForm" method="POST">
                    <label for="pName">Product Name</label>
                    <input type="pname" id="pName" name="pname" placeholder="Enter Product Name" required>
                    <label for="fName">First Name</label>
                    <input type="fname" id="fName" name="fname" placeholder="Enter First Name" required>
                    <label for="lName">Last Name</label>
                    <input type="lname" id="lName" name="lname" placeholder="Enter Last Name" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" required>
                    <label for="contactNum">Contact Number</label>
                    <input type="tel" id="contactNum" name="contactNum" maxlength="11" value="09" required>
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity" min="1" max="999" value="1" required>
                    <div class="btn-container">
                        <button type="submit" name="confirmBtn" id="confirmBtn">Confirm</button>
                        <button type="button" id="cancelBtn">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="successpcModal" class="modal">
            <div class="modal-content pcmodal2">
                <h2>Reservation Completed!</h2>
                <button type="button" id="goBackBtn">Go Back</button>
            </div>
        </div>

        <!---------------
            JS FOR PC
        ---------------->
       <script>
            document.addEventListener("DOMContentLoaded", function() {
                var photos = document.querySelectorAll(".sulitPcContents img");

                photos.forEach(function(photo) {
                    photo.addEventListener("click", function(event) {
                        event.preventDefault();

                        var productId = this.getAttribute("alt");

                        var pNameInput = document.getElementById("pName");
                        pNameInput.value = productId;
                        
                        var reserveModal = document.getElementById("reservepcModal");
                        reserveModal.style.display = "block";
                    });
                });

                var reserveButtons = document.querySelectorAll(".reserve1");

                reserveButtons.forEach(function(button) {
                    button.addEventListener("click", function(event) {
                        event.preventDefault(); 

                        var reserveModal = document.getElementById("reservepcModal");

                        reserveModal.style.display = "block";

                        var pNameInput = document.getElementById("pName");
                        pNameInput.value = "SULIT PC ";
                    });
                });

                var cancelButton = document.getElementById("cancelBtn");

                cancelButton.addEventListener("click", function(event) {
                    event.preventDefault();

                    var reserveModal = document.getElementById("reservepcModal");

                    reserveModal.style.display = "none";
                });

                var pNameInput = document.getElementById("pName");

                pNameInput.addEventListener("input", function() {
                    var enteredValue = this.value.replace("SULIT PC ", "");
                    this.value = "SULIT PC " + enteredValue.replace(/[^0-9]/g, '');
                });

                var firstNameInput = document.getElementById("fName");
                var lastNameInput = document.getElementById("lName");

                firstNameInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                });

                lastNameInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                });

                var contactNumInput = document.getElementById("contactNum");

                contactNumInput.addEventListener("input", function() {
                    if (!this.value.startsWith("09")) {
                        this.value = "09" + this.value.slice(2);
                    }
                    this.value = this.value.replace(/[^0-9]/g, '');
                    if (this.value.length > 11) {
                        this.value = this.value.slice(0, 11);
                    }
                });

                var emailInput = document.getElementById("email");

                emailInput.addEventListener("input", function() {
                    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(this.value)) {
                        this.setCustomValidity("Please enter a valid email address.");
                    } else {
                        this.setCustomValidity("");
                    }
                });

                var quantityInput = document.getElementById("quantity");

                quantityInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^0-9]/g, '');

                    if (this.value.length > 3) {
                        this.value = this.value.slice(0, 3);
                    }
                });
            });
        </script>



        <!---------------
          SULIT LAPTOPS
        ---------------->
        <section class="sulitLaptop">
            <div class="text-center">
                <h2>LAPTOP</h2>
                <p class="sentence1">Discover our best-selling laptops, offering portability and power for your needs.</p>
            </div>

            <div class="sulitLaptopContents">
            <?php 
                $sql = "SELECT * FROM inventory WHERE 	products_id  LIKE '%SULIT LAPTOP%'  ORDER BY RAND()  LIMIT 3"; 
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        
            ?>
            <div class="row">
            <img src="data:image;base64,<?php echo base64_encode($row['image']); ?>" alt2="<?php echo $row['products_id']; ?>">
                <h4><?php echo $row['products_name']; ?></h4>
                <h5><?php echo $row['products_id']; ?></h5>
                <h6>₱<?php echo $row['unit_price']; ?></h6>
            </div>
            <?php
                    }
                }
            ?>
            </div>

            <div class="shortcut">
                <a class="btn-fdbck2" href="customer-pricelist.html">SULIT LAPTOP Pricelists</a>
                <button class="btn-fdbck reserve2">Reserve</button>
            </div>
        </section>



        <!---------------
          LAPTOP MODAL
        ---------------->
        <div id="reservelaptopModal" class="modal">
            <div class="modal-content laptopmodal">
                <h2>Reservation For Sulit Laptops</h2>
                <form id="reserveForm2" method="POST">
                    <label for="pName2">Product Name</label>
                    <input type="pname" id="pName2" name="pname2" placeholder="Enter Product Name" required>
                    <label for="fName">First Name</label>
                    <input type="fname" id="fName2" name="fname2" placeholder="Enter First Name" required>
                    <label for="lName">Last Name</label>
                    <input type="lname" id="lName2" name="lname2" placeholder="Enter Last Name" required>
                    <label for="email">Email</label>
                    <input type="email" id="email2" name="email2" placeholder="Enter Email" required>
                    <label for="contactNum">Contact Number</label>
                    <input type="tel" id="contactNum2" name="contactNum2" maxlength="11" value="09" required>
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity2" name="quantity2" min="1" max="999" value="1" required>
                    <div class="btn-container">
                        <button type="submit" name="confirmBtn2" id="confirmBtn2">Confirm</button>
                        <button type="button" id="cancelBtn2">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="successlaptopModal" class="modal">
            <div class="modal-content laptopmodal2">
                <h2>Reservation Completed!</h2>
                <button type="button" id="goBackBtn">Go Back</button>
            </div>
        </div>

        <!---------------
          JS FOR LAPTOP
        ---------------->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var photos = document.querySelectorAll(".sulitLaptopContents img");

                photos.forEach(function(photo) {
                    photo.addEventListener("click", function(event) {
                        event.preventDefault();

                        var productId = this.getAttribute("alt2");

                        var pNameInput = document.getElementById("pName2");
                        pNameInput.value = productId;
                        
                        var reserveModal = document.getElementById("reservelaptopModal");
                        reserveModal.style.display = "block";
                    });
                });

                var reserveButtons = document.querySelectorAll(".reserve2");

                reserveButtons.forEach(function(button) {
                    button.addEventListener("click", function(event) {
                        event.preventDefault(); 

                        var reserveModal = document.getElementById("reservelaptopModal");

                        reserveModal.style.display = "block";

                        var pNameInput = document.getElementById("pName2");
                        pNameInput.value = "SULIT LAPTOP ";
                    });
                });

                var cancelButton = document.getElementById("cancelBtn2");

                cancelButton.addEventListener("click", function(event) {
                    event.preventDefault();

                    var reserveModal = document.getElementById("reservelaptopModal");

                    reserveModal.style.display = "none";
                });

                var pNameInput = document.getElementById("pName2");

                pNameInput.addEventListener("input", function() {
                    var enteredValue = this.value.replace("SULIT LAPTOP ", "");
                    this.value = "SULIT LAPTOP " + enteredValue.replace(/[^0-9]/g, '');
                });

                var firstNameInput = document.getElementById("fName2");
                var lastNameInput = document.getElementById("lName2");

                firstNameInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                });

                lastNameInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                });

                var contactNumInput = document.getElementById("contactNum2");

                contactNumInput.addEventListener("input", function() {
                    if (!this.value.startsWith("09")) {
                        this.value = "09" + this.value.slice(2);
                    }
                    this.value = this.value.replace(/[^0-9]/g, '');
                    if (this.value.length > 11) {
                        this.value = this.value.slice(0, 11);
                    }
                });

                var emailInput = document.getElementById("email2");

                emailInput.addEventListener("input", function() {
                    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(this.value)) {
                        this.setCustomValidity("Please enter a valid email address.");
                    } else {
                        this.setCustomValidity("");
                    }
                });

                var quantityInput = document.getElementById("quantity2");

                quantityInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^0-9]/g, '');

                    if (this.value.length > 3) {
                        this.value = this.value.slice(0, 3);
                    }
                });
            });
        </script>



        <!---------------
          SULIT PRINTER
        ---------------->
        <section class="sulitPrinter">
            <div class="text-center">
                <h2>PRINTER</h2>
                <p class="sentence1">Explore our best-selling printers, known for their quality and efficiency.</p>
            </div>

            <div class="sulitPrinterContents">
            <?php 
                $sql = "SELECT * FROM inventory WHERE 	products_id  LIKE '%SULIT PRINTER%'  ORDER BY RAND()  LIMIT 3"; 
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                    
            ?>
            <div class="row">
            <img src="data:image;base64,<?php echo base64_encode($row['image']); ?>" alt3="<?php echo $row['products_id']; ?>">
                <h4><?php echo $row['products_name']; ?></h4>
                <h5><?php echo $row['products_id']; ?></h5>
                <h6>₱<?php echo $row['unit_price']; ?></h6>
            </div>
            <?php
                    }
                }
            ?>
            </div>

            <div class="shortcut">
                <a class="btn-fdbck" href="customer-pricelist.html">SULIT PRINTER Pricelists</a>
                <a class="btn-fdbck reserve3" href="customer-pricelist.html">Reserve</a>
            </div>
        </section>



        <!---------------
          PRINTER MODAL
        ---------------->
        <div id="reserveprinterModal" class="modal">
            <div class="modal-content printermodal">
                <h2>Reservation For Sulit Printers</h2>
                <form id="reserveForm3" method="POST">
                    <label for="pName3">Product Name</label>
                    <input type="pname" id="pName3" name="pname3" placeholder="Enter Product Name" required>
                    <label for="fName">First Name</label>
                    <input type="fname" id="fName3" name="fname3" placeholder="Enter First Name" required>
                    <label for="lName">Last Name</label>
                    <input type="lname" id="lName3" name="lname3" placeholder="Enter Last Name" required>
                    <label for="email">Email</label>
                    <input type="email" id="email3" name="email3" placeholder="Enter Email" required>
                    <label for="contactNum">Contact Number</label>
                    <input type="tel" id="contactNum3" name="contactNum3" maxlength="11" value="09" required>
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity3" name="quantity3" min="1" max="999" value="1" required>
                    <div class="btn-container">
                        <button type="submit" name="confirmBtn3" id="confirmBtn3">Confirm</button>
                        <button type="button" id="cancelBtn3">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="successprinterModal" class="modal">
            <div class="modal-content printermodal2">
                <h2>Reservation Completed!</h2>
                <button type="button" id="goBackBtn">Go Back</button>
            </div>
        </div>

        <!---------------
          JS FOR PRINTER
        ---------------->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var photos = document.querySelectorAll(".sulitPrinterContents img");

                photos.forEach(function(photo) {
                    photo.addEventListener("click", function(event) {
                        event.preventDefault();

                        var productId = this.getAttribute("alt3");

                        var pNameInput = document.getElementById("pName3");
                        pNameInput.value = productId;
                        
                        var reserveModal = document.getElementById("reserveprinterModal");
                        reserveModal.style.display = "block"; 
                    });
                });

                var reserveButtons = document.querySelectorAll(".reserve3");

                reserveButtons.forEach(function(button) {
                    button.addEventListener("click", function(event) {
                        event.preventDefault(); 

                        var reserveModal = document.getElementById("reserveprinterModal");

                        reserveModal.style.display = "block";

                
                        var pNameInput = document.getElementById("pName3");
                        pNameInput.value = "SULIT PRINTER ";
                    });
                });

                var cancelButton = document.getElementById("cancelBtn3");

                cancelButton.addEventListener("click", function(event) {
                    event.preventDefault();

                    var reserveModal = document.getElementById("reserveprinterModal");

                    reserveModal.style.display = "none";
                });

                var pNameInput = document.getElementById("pName3");

                pNameInput.addEventListener("input", function() {
                    var enteredValue = this.value.replace("SULIT PRINTER ", "");
                    this.value = "SULIT PRINTER " + enteredValue.replace(/[^0-9]/g, '');
                });


                var firstNameInput = document.getElementById("fName3");
                var lastNameInput = document.getElementById("lName3");

                firstNameInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                });

                lastNameInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                });

                var contactNumInput = document.getElementById("contactNum3");

                contactNumInput.addEventListener("input", function() {
                    if (!this.value.startsWith("09")) {
                        this.value = "09" + this.value.slice(2);
                    }
                    this.value = this.value.replace(/[^0-9]/g, '');
                    if (this.value.length > 11) {
                        this.value = this.value.slice(0, 11);
                    }
                });

                var emailInput = document.getElementById("email3");

                emailInput.addEventListener("input", function() {
                    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(this.value)) {
                        this.setCustomValidity("Please enter a valid email address.");
                    } else {
                        this.setCustomValidity("");
                    }
                });

                var quantityInput = document.getElementById("quantity3");

                quantityInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^0-9]/g, '');

                    if (this.value.length > 3) {
                        this.value = this.value.slice(0, 3);
                    }
                });
            });
        </script>



        <!---------------
         SULIT ACCESSORY
        ---------------->
        <section class="otherAcc">
            <div class="text-center">
                <h2>Other Accessories</h2>
                <p class="sentence1">You can also check our other offers.</p>
            </div>
            
            <div class="shortcut2">
                <a href="customer-pricelist.html" class="btn-fdbck-other">Others Pricelists</a>
                <button class="btn-fdbck-other reserve4">Reserve</button>
            </div>
        </section>



        <!---------------
          ACCESSORY MODAL
        ---------------->
        <div id="reserveothersModal" class="modal">
            <div class="modal-content othersmodal">
                <h2>Reservation For Accessories</h2>
                <form id="reserveForm4" method="POST">
                    <label for="pName4">Product Name</label>
                    <input type="pname" id="pName4" name="pname4" placeholder="Enter Product Name" required>
                    <label for="fName">First Name</label>
                    <input type="fname" id="fName4" name="fname4" placeholder="Enter First Name" required>
                    <label for="lName">Last Name</label>
                    <input type="lname" id="lName4" name="lname4" placeholder="Enter Last Name" required>
                    <label for="email">Email</label>
                    <input type="email" id="email4" name="email4" placeholder="Enter Email" required>
                    <label for="contactNum">Contact Number</label>
                    <input type="tel" id="contactNum4" name="contactNum4" maxlength="11" value="09" required>
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity4" name="quantity4" min="1" max="999" value="1" required>
                    <div class="btn-container">
                        <button type="submit" name="confirmBtn4" id="confirmBtn4">Confirm</button>
                        <button type="button" id="cancelBtn4">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="successothersModal" class="modal">
            <div class="modal-content othersmodal2">
                <h2>Reservation Completed!</h2>
                <button type="button" id="goBackBtn">Go Back</button>
            </div>
        </div>

        <!---------------
         JS FOR ACCESSORY 
        ---------------->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var reserveButtons = document.querySelectorAll(".reserve4");

                reserveButtons.forEach(function(button) {
                    button.addEventListener("click", function(event) {
                        event.preventDefault(); 

                        var reserveModal = document.getElementById("reserveothersModal");

                        reserveModal.style.display = "block";

            
                        var pNameInput = document.getElementById("pName4");
                        pNameInput.value = "SULIT ACCESSORY ";
                    });
                });

                var pNameInput = document.getElementById("pName4");

                pNameInput.addEventListener("input", function() {   
                    var enteredValue = this.value.replace("SULIT ACCESSORY ", "");
                    this.value = "SULIT ACCESSORY " + enteredValue.replace(/[^0-9]/g, '');
                });

                var cancelButton = document.getElementById("cancelBtn4");

                cancelButton.addEventListener("click", function(event) {
                    event.preventDefault();

                    var reserveModal = document.getElementById("reserveothersModal");

                    reserveModal.style.display = "none";
                });

                var firstNameInput = document.getElementById("fName4");
                var lastNameInput = document.getElementById("lName4");

                firstNameInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                });

                lastNameInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                });

                var contactNumInput = document.getElementById("contactNum4");

                contactNumInput.addEventListener("input", function() {
                    if (!this.value.startsWith("09")) {
                        this.value = "09" + this.value.slice(2);
                    }
                    this.value = this.value.replace(/[^0-9]/g, '');
                    if (this.value.length > 11) {
                        this.value = this.value.slice(0, 11);
                    }
                });

                var emailInput = document.getElementById("email4");

                emailInput.addEventListener("input", function() {
                    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(this.value)) {
                        this.setCustomValidity("Please enter a valid email address.");
                    } else {
                        this.setCustomValidity("");
                    }
                });

                var quantityInput = document.getElementById("quantity4");

                quantityInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^0-9]/g, '');

                    if (this.value.length > 3) {
                        this.value = this.value.slice(0, 3);
                    }
                });
            });
        </script>



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
                    <li><a href="admin-login.php">Admin Panel</a></li>
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
