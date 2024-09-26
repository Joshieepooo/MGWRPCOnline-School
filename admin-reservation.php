<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!---------------
               TAB
        ---------------->
        <title>MGWR PC | Reservation</title>
        <link rel="icon" href="Images/Tab Icon.png" type="image/x-icon">
    
        <!---------------
             CSS & JS
        ---------------->
        <link rel="stylesheet" href="css/admin-inventory.css">
        <link rel="stylesheet" href="css/admin-mainstyle.css">
        <script src="js/admin-inventory.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
        <!---------------
               PHP
        ---------------->
       <?php
            include 'PHP/checker.php';
            ?>
            
        <?php
            if (isset($_POST['update_product'])) {
                @include 'PHP/admin-config.php';
                @include 'PHP/admin-update-add-reservation.php';
            } else {
                @include 'PHP/admin-config.php';
                @include 'PHP/admin-update-reservation.php';
            }
        ?>
    
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-oP7mI/HC6pVx2jzrLnMlqA25eXHVTQwYb3CgeCLHq/9ItT5qro5BxxL5tWnfqFi/OA7NTVAtTAjyQq62oyC7Ig==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <a href="admin-inventory.php" style="--i:0">Inventory</a>
                <a class="active" href="admin-reservation.php" style="--i:1">Reservation</a>
                <a href="admin-cms.php" style="--i:2">CMS</a>
                <a href="admin-feedback.php" style="--i:3">Feedbacks</a>
                <a href="admin-contact-us.php" style="--i:4">Inbox</a>
            </nav>
        </header> 
    
    
        
        <!---------------
           RESERVATION
        ---------------->
        <div class="container-main">
            <div class="container1">
                <main class="table" id="customers_table">
                    <section class="table__header">
                        <h2>RESERVATION</h2>
                        <div class="input-group">
                            <input type="search" placeholder="Search Data..." id="reservationSearchInput" onkeyup="searchTable2()">
                        </div>
                        <button class="add" data-toggle="modal" data-target="#addModalReservation">ADD</button>
                    </section>
    
                    <section class="table__body">
                        <table id="reservationTable">
                            <thead class="thead">
                                <tr>
                                    <th> RESERVATION ID </th>
                                    <th> CUSTOMER ID </th>
                                    <th> PRODUCT ID </th>
                                    <th> EMAIL</th>
                                    <th> CONTACT#</th>
                                    <th> QUANTITY </th>
                                    <th> STATUS </th>
                                    <th> UPDATE </th>
                                </tr>
                            </thead>
    
                            <tbody>
                                <?php 
                                    $select = mysqli_query($conn, "SELECT * FROM reservation");
                                    while($row = mysqli_fetch_assoc($select)){ 
                                        ?>
                                        <tr>
                                            <td><?php echo $row['IDreservation']; ?></td>
                                            <td><?php echo $row['customer']; ?></td>
                                            <td><?php echo $row['product']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['num']; ?></td>
                                            <td><?php echo $row['reserved_units']; ?></td>
                                            <td>
                                                <p class="status <?php echo $row['status']; ?>"><?php echo strtoupper($row['status']); ?></p>
                                            </td>
                                            <td>
                                                <button class="status edit" data-toggle="modal" data-target="#reservationmodal" 
                                                        data-id="<?php echo $row['IDreservation']; ?>" 
                                                        data-status="<?php echo $row['status']; ?>">
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>
                                    <?php 
                                    } 
                                ?>
                            </tbody>
                        </table>
                    </section>
                </main>
            </div>
        </div>
    
    
    
        <!---------------
        RESERVATION POPUP
        ---------------->
        <div class="modal fade" id="reservationmodal" tabindex="-1" role="dialog" aria-labelledby="reservationmodalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reservationmodalLabel">Update Reservation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="reservationForm" method="post" >
                            <div class="form-group">
                                <label for="reservation_id">Reservation ID</label>
                                <input type="text" class="form-control" id="reservation_id" name="reservation_id" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="action closebtn" data-dismiss="modal">Close</button>
                                <button type="button" class="action save" onclick="$('#reservationForm').submit();" name="Save_content">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    
    
        <!------------------
          ADD RESERVATION
        ------------------->
        <div class="modal fade" id="addModalReservation" tabindex="-1" role="dialog" aria-labelledby="addModalReservationLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalReservationLabel">Add Reservation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" >
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                            </div>
                            <div class="form-group">
                                <label for="sulitcategory">Category</label>
                                <select class="form-control" id="sulitcategory" name="sulitcategory">
                                    <option value="sulitpcoption">Sulit PC</option>
                                    <option value="sulitlaptopoption">Sulit Laptop</option>
                                    <option value="sulitprinteroption">Sulit Printer</option>
                                    <option value="sulitaccessoryoption">Sulit Accessory</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_id">PRODUCT ID</label>
                                <input type="text"  class="form-control" id="product_id" name="product_id" placeholder="Product ID" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" min="0" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="1" required>
                            </div>
                
                            <button type="submit" name="update_product" class="action updateproduct">SAVE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    
    
        <!---------------
               JS
        ---------------->
        <script src="admin-inventory.js"></script>
        <script src="https://kit.fontawesome.com/865faf11ce.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                $('button.status.edit').click(function() {
                    var reservationId = $(this).data('id');
                    var status = $(this).data('status');
    
                    $('#reservation_id').val(reservationId);
                    $('#status').val(status); 
                });
    
                var firstNameInput = document.getElementById("first_name");
                var lastNameInput = document.getElementById("last_name");
    
                firstNameInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                });
    
                lastNameInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
                });
    
                var quantityInput = document.getElementById("quantity");

                quantityInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^0-9]/g, '');

                    if (this.value.length > 3) {
                        this.value = this.value.slice(0, 3);
                    }
                });
    
                var productIDInput = document.getElementById("product_id");
                var sulitCategorySelect = document.getElementById("sulitcategory");
    
                sulitCategorySelect.addEventListener("change", function() {
                    updateProductID();
                });
    
                productIDInput.addEventListener("input", function() {
                    updateProductID();
                });
    
                function updateProductID() {
                    var selectedCategory = sulitCategorySelect.options[sulitCategorySelect.selectedIndex].text;
                    var prefix = selectedCategory + " ";
                    var enteredValue = productIDInput.value.replace(prefix, "").replace(/[^0-9]/g, '').slice(0, 5);
                    productIDInput.value = prefix + enteredValue;
                }
    
                updateProductID();
    
                document.getElementById("sulitcategory").addEventListener("change", function() {
                    var select = document.getElementById("sulitcategory");
                    var selectedValue = select.options[select.selectedIndex].value;
    
                    switch(selectedValue) {
                        case "sulitpcoption":
                            select.style.backgroundColor = "#ffcccc";
                            break;
                        case "sulitlaptopoption":
                            select.style.backgroundColor = "#ccffcc";
                            break;
                        case "sulitprinteroption":
                            select.style.backgroundColor = "#ccccff";
                            break;
                        case "sulitaccessoryoption":
                            select.style.backgroundColor = "#cfcfcf";
                            break;
                        default:
                            select.style.backgroundColor = "#ffcccc";
                            break;
                    }
                });
                document.getElementById("sulitcategory").dispatchEvent(new Event('change'));
            });
        </script>
    </body>
</html>
