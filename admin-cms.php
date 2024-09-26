<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!---------------
               PHP
        ---------------->
        <?php include "PHP/promotion.php"; ?>
        <?php include "PHP/save_content.php"; ?>
    
       <?php
            include 'PHP/checker.php';
            ?>
    
        <!---------------
               TAB
        ---------------->
        <title>MGWR PC | CMS</title>
        <link rel="icon" href="Images/Tab Icon.png" type="image/x-icon">
    
        <!---------------
             CSS & JS
        ---------------->
        <link rel="stylesheet" href="css/mainstyle.css">
        <link rel="stylesheet" href="css/admin-cms.css">
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
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    </head>
    
    
    
    <body>
        <!---------------
              NAVBAR
        ---------------->
        <header class="header">
            <a href="admin-analytics.php"><img src="Images/MGWR PC Logo.png" alt="" class="logo"></a>
    
            <input type="checkbox" id="check">
            <label for="check" class="icons">
                <img src="Images/Menu.png" alt="" id="menu-icon">
                <img src="Images/MenuX.png" alt="" id="close-icon">
            </label>
       
            <nav class="navbar">
                <a href="admin-analytics.php" style="--i:0">Analytics</a>
              <a href="admin-inventory.php" style="--i:1">Inventory</a>
                <a href="admin-reservation.php" style="--i:1">Reservation</a>
                <a class="active" href="admin-cms.php" style="--i:2">CMS</a>
                <a href="admin-feedback.php" style="--i:3">Feedbacks</a>
                <a href="admin-contact-us.php" style="--i:4">Inbox</a>
            </nav>
        </header>    
    
    
    
        <!---------------
              POPUP
        ---------------->
        <button id="openPopup">UPDATE PHOTO</button>
        <div id="overlay" style="display: none;">
        
            <div id="popup">
                <h2 id="updatephotohead">Update Photo</h2>
                <form id="updatePhotoForm" enctype="multipart/form-data"  method="POST">
                    <label for="photoInput">Click Me & Choose A Photo:</label>
                    <input type="file" id="photoInput" name="photo" accept="image/*" >
                    <span id="fileName1"></span>
                    <button type="submit" name="submit">Upload</button><br/>
    
                    <label for="photoInput2">Click Me & Choose A Photo:</label>
                    <input type="file" id="photoInput2" name="photo2" accept="image/*" >
                    <span id="fileName2"></span>
                    <button type="submit" name="submit2">Upload</button><br/>
    
                    <label for="photoInput3">Click Me & Choose A Photo:</label>
                    <input type="file" id="photoInput3" name="photo3" accept="image/*" > 
                    <span id="fileName3"></span>
                    <button type="submit" name="submit3">Upload</button><br/>
    
                    <label for="photoInput4">Click Me & Choose A Photo:</label>
                    <input type="file" id="photoInput4" name="photo4" accept="image/*" >
                    <span id="fileName4"></span>
                    <button type="submit" name="submit4">Upload</button><br/>
    
                    <label for="photoInput5">Click Me & Choose A Photo:</label>
                    <input type="file" id="photoInput5" name="photo5" accept="image/*" >
                    <span id="fileName5"></span>
                    <button type="submit" name="submit5">Upload</button>
                </form>
     
                <button id="closePopup">Close</button>
            </div>
        </div>
    
        <script>
            document.getElementById('photoInput').addEventListener('change', function() {
                var fileName = this.files[0] ? this.files[0].name : '';
                document.getElementById('fileName1').textContent = fileName;
            });
    
            document.getElementById('photoInput2').addEventListener('change', function() {
                var fileName = this.files[0] ? this.files[0].name : '';
                document.getElementById('fileName2').textContent = fileName;
            });
    
            document.getElementById('photoInput3').addEventListener('change', function() {
                var fileName = this.files[0] ? this.files[0].name : '';
                document.getElementById('fileName3').textContent = fileName;
            });
    
            document.getElementById('photoInput4').addEventListener('change', function() {
                var fileName = this.files[0] ? this.files[0].name : '';
                document.getElementById('fileName4').textContent = fileName;
            });
    
            document.getElementById('photoInput5').addEventListener('change', function() {
                var fileName = this.files[0] ? this.files[0].name : '';
                document.getElementById('fileName5').textContent = fileName;
            });
        </script>
    
        <!---------------
            PROMOTIONS
        ---------------->
        <section class="slider-container">
            <div class="slider">
                <div class="list">
                    <div class="item">
                        <img src="<?php echo $promoImage; ?>" alt="" value="1">
                    </div>
                    <div class="item">
                        <img src="<?php echo $promoImage2; ?>" alt="" value="2">
                    </div>
                    <div class="item">
                        <img src="<?php echo $promoImage3; ?>" alt="" value="3">
                    </div>
                    <div class="item">
                        <img src="<?php echo $promoImage4; ?>" alt="" value="4">
                    </div>
                    <div class="item">
                        <img src="<?php echo $promoImage5; ?>" alt="" value="5">
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
            INLINE JS
        ---------------->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const openButton = document.getElementById('openPopup');
                const popup = document.getElementById('popup');
                const overlay = document.getElementById('overlay');
                const closeButton = document.getElementById('closePopup');
    
                function openPopup() {
                    overlay.style.display = 'flex'; 
                    popup.style.display = 'block'; 
                }
    
                function closePopup() {
                    overlay.style.display = 'none'; 
                    popup.style.display = 'none'; 
                }
    
                openButton.addEventListener('click', openPopup);
                closeButton.addEventListener('click', closePopup);
            });
        </script>
    
    
    
       <!---------------
            ABOUT US
        ---------------->
            <section class="about">
            <div class="main">
                <div class="image-container">
                    <label for="imageInput1">
                        <img id="previewImage" src="<?php echo $abt; ?>" alt="Company Image">
                    </label>
                </div>
                <div class="all-text">
                    <h4>WHO ARE WE</h4>
                    <h1>MGWR PC</h1>
                    <p><?php echo $compinf; ?></p>
                    <button type="button" class="abouteditbutton" id="editButton">Edit</button>
                </div>
            </div>
        </section>
        
        <!---------------
         UPDATE ABOUT US
        ---------------->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    <h2 id="aboutHead">Edit Company Info</h2>
                    <label id="comInfo" for="popupCompanyInfo">Company Info:</label>
                    <textarea id="popupCompanyInfo" name="company_info" rows="10" cols="50" maxlength="1000"></textarea>
                    
                    <label for="ABTPHOTO">Click Me & Choose A Photo:</label>
                    <input type="file" id="ABTPHOTO" name="ABTPHOTO" accept="image/*">
                    <span id="aboutfileName"></span>
                    <button type="submit" name="ABTPHOTOSUB">Upload</button><br/>
                    
                    <div class="btn-container">
                        <button type="submit" id="aboutSaveButton" name="saveButton">Save</button>
                        <button type="button" id="aboutBackButton">Back</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!---------------
            INLINE JS
        ---------------->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const editButton = document.getElementById("editButton");
                const editModal = document.getElementById("editModal");
                const popupCompanyInfo = document.getElementById("popupCompanyInfo");
                const saveButton = document.getElementById("aboutSaveButton");
                const cancelButton = document.getElementById("aboutBackButton");
                const abtPhoto = document.getElementById("ABTPHOTO");
                const abtPhotoSub = document.getElementsByName("ABTPHOTOSUB")[0];
                const editForm = document.getElementById("editForm");
    
                editButton.addEventListener("click", function () {
                    editModal.style.display = "block";
                });
    
                cancelButton.addEventListener("click", function () {
                    editModal.style.display = "none";
                });
    
                window.addEventListener("click", function (event) {
                    if (event.target == editModal) {
                        editModal.style.display = "none";
                    }
                });
    
                abtPhoto.addEventListener('change', function() {
                    var fileName = this.files[0] ? this.files[0].name : '';
                    document.getElementById('aboutfileName').textContent = fileName;
                });
    
                editForm.addEventListener('submit', function(event) {
                    if (abtPhoto.files.length > 0) {
                        const file = abtPhoto.files[0];
                        const fileSize = file.size; 
                        const maxSize = 1024 * 1024; 
    
                        if (fileSize > maxSize) {
                            alert("Image size cannot exceed 1 MB. Try to compress your file.");
                            event.preventDefault(); 
                        }
                    }
                });
    
                abtPhotoSub.addEventListener('click', function(event) {
                    if (abtPhoto.files.length === 0) {
                        alert("Please select a file to upload.");
                        event.preventDefault(); 
                    } else {
                        const file = abtPhoto.files[0];
                        const fileType = file.type;
                        const validImageTypes = ["image/jpeg", "image/png", "image/gif", "image/bmp"];
    
                        if (!validImageTypes.includes(fileType)) {
                            alert("Please upload a valid image file (JPEG, PNG, GIF, BMP).");
                            event.preventDefault(); // Prevent form submission
                        }
                    }
                });
            });
        </script>
        
        
        
        <!---------------
            PRICELIST
        ---------------->
        <section class="wrapper">
            <h1 class="heading">Price List</h1>
    
            <div class="content-box">
                <div class="card">
                    <i class="bx bx-desktop bx-md"></i>
                    <h2>Pricelist For PCs</h2>
                    <p>Explore our range of high-performance desktop computers. Check our price list to find the perfect fit for your needs.</p>
                    <form action="PHP/pc_upload.php" method="post" enctype="multipart/form-data">
                        <label for="fileToUpload1">Click Me & Choose A File:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload1">
                        <span id="pricelistfileupload1"></span>
                        <button type="submit" name="prclstbtn1">Upload</button>
                    </form>
                </div>
    
                <div class="card">
                    <i class="bx bx-laptop bx-md"></i>
                    <h2>Pricelist For Laptops</h2>
                    <p>Discover our selection of reliable and portable laptops. Don't forget to check our price list for great deals.</p>
                    <form action="PHP/laptop_upload.php" method="post" enctype="multipart/form-data">
                        <label for="fileToUpload2">Click Me & Choose A File:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload2">
                        <span id="pricelistfileupload2"></span>
                        <button type="submit" name="prclstbtn2">Upload</button>
                    </form>
                </div>
                
                <div class="card">
                    <i class="bx bx-printer bx-md"></i>
                    <h2>Pricelist For Printers</h2>
                    <p>Find the ideal printer for your home or office needs among our quality selection. Check out our price list for competitive pricing.</p>     
                    <form action="PHP/printer_upload.php" method="post" enctype="multipart/form-data">
                        <label label for="fileToUpload3">Click Me & Choose A File:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload3">
                        <span id="pricelistfileupload3"></span>
                        <button type="submit" name="prclstbtn3">Upload</button>
                    </form>
                </div>
    
                <div class="card">
                    <i class="bx bx-package bx-md"></i>
                    <h2>Pricelist For Others</h2>
                    <p>Enhance your computing experience with our range of accessories. From cables to peripherals, find what you need in our price list.</p>        
                    <form action="PHP/others_upload.php" method="post" enctype="multipart/form-data">
                        <label for="fileToUpload4">Click Me & Choose A File:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload4">
                        <span id="pricelistfileupload4"></span>
                        <button type="submit" name="prclstbtn4">Upload</button>
                    </form>
                </div>
            </div>
        </section>
    
        <!---------------
            INLINE JS
        ---------------->
        <script>
            document.getElementById('fileToUpload1').addEventListener('change', function() {
                var fileName = this.files[0] ? this.files[0].name : '';
                document.getElementById('pricelistfileupload1').textContent = fileName;
            });
    
            document.getElementById('fileToUpload2').addEventListener('change', function() {
                var fileName = this.files[0] ? this.files[0].name : '';
                document.getElementById('pricelistfileupload2').textContent = fileName;
            });
    
            document.getElementById('fileToUpload3').addEventListener('change', function() {
                var fileName = this.files[0] ? this.files[0].name : '';
                document.getElementById('pricelistfileupload3').textContent = fileName;
            });
    
            document.getElementById('fileToUpload4').addEventListener('change', function() {
                var fileName = this.files[0] ? this.files[0].name : '';
                document.getElementById('pricelistfileupload4').textContent = fileName;
            });
        </script>
    
    
    
        <!---------------
              FAQs
        ---------------->
        <h1 class="heading" id="question">FAQs</h1>

        <section class="faqs">
            <div class="container">
                <div class="list">
                    
                <?php include "PHP/display_faqs.php"; ?>
    
                    <button id="toggleFormButton">Add</button>
                    <button id="toggleDeleteButtons">Delete</button>
                        
                    <form id="addFaqForm" action="PHP/add_faq.php" method="post" style="display: none;">
                    <span id="closeFormButton" style="position: absolute; top: 5px; right: 20px; cursor: pointer; font-size: 40px;">&times;</span>
                        <input type="text" id="new_question" name="new_question" placeholder="Question" required><br>
                        <textarea id="new_answer" name="new_answer" rows="4" cols="50" placeholder="Answer" required></textarea><br>
                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </section>
    
    
    
        <!---------------
            INLINE JS
        ---------------->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            const listLinks = document.querySelectorAll('.list-link');
    
                listLinks.forEach(link => {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        
                        const answer = this.nextElementSibling;
                        const allAnswers = document.querySelectorAll('.answer');
                        const allIconsAdd = document.querySelectorAll('.ion-md-add');
                        const allIconsRemove = document.querySelectorAll('.ion-md-remove');
    
                        allAnswers.forEach(ans => {
                            ans.style.maxHeight = null;
                        });
    
                        allIconsAdd.forEach(icon => {
                            icon.style.display = 'inline';
                        });
    
                        allIconsRemove.forEach(icon => {
                            icon.style.display = 'none';
                        });
    
                        if (answer.classList.contains('expanded')) {
                            answer.classList.remove('expanded');
                            this.querySelector('.ion-md-add').style.display = 'inline';
                            this.querySelector('.ion-md-remove').style.display = 'none';
                        } else {
                            allAnswers.forEach(ans => {
                                ans.classList.remove('expanded');
                                ans.style.maxHeight = null;
                            });
    
                            answer.classList.add('expanded');
                            answer.style.maxHeight = answer.scrollHeight + 'px';
                            this.querySelector('.ion-md-add').style.display = 'none';
                            this.querySelector('.ion-md-remove').style.display = 'inline';
                        }
                    });
                });
                
                const toggleFormButton = document.getElementById('toggleFormButton');
                const addFaqForm = document.getElementById('addFaqForm');
                const closeFormButton = document.getElementById('closeFormButton');
    
                toggleFormButton.addEventListener('click', function() {
                    if (addFaqForm.style.display === 'none') {
                        addFaqForm.style.display = 'block';
                        document.getElementById('new_question').scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else {
                        addFaqForm.style.display = 'none';
                    }
                });
    
                closeFormButton.addEventListener('click', function() {
                    addFaqForm.style.display = 'none';
                });
    
                const toggleDeleteButtons = document.getElementById('toggleDeleteButtons');
                const deleteFaqButtons = document.querySelectorAll('.delete-faq');
                
                toggleDeleteButtons.addEventListener('click', function() {
                    deleteFaqButtons.forEach(button => {
                        button.style.display = button.style.display === 'none' ? 'block' : 'none';
                    });
                });
    
                deleteFaqButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const faqId = this.parentElement.getAttribute('data-id');
                        
                        if (confirm('Are you sure you want to delete this FAQ?')) {
                            fetch('PHP/delete_faq.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json', 
                                },
                                body: JSON.stringify({ id: faqId }) 
                            })
                            .then(response => response.json()) 
                            .then(data => {
                                if (data.success) {
                                    this.parentElement.remove();
                                } else {
                                    alert('Failed to delete FAQ: ' + data.error);
                                }
                            })
                            .catch(error => console.error('Error:', error));
                        }
                    });
                });
            });
        </script>
    </body>
</html>