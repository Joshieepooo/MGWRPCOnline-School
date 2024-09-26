<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!---------------
               TAB
        ---------------->
        <title>MGWR PC | Inventory</title>
        <link rel="icon" href="Images/Tab Icon.png" type="image/x-icon">

        <!------
          PHP
        ------->

        <?php
            include 'PHP/con_db.php';
            include 'PHP/adminchecker.php';
        ?>

        <!---------------
            CSS & JS
        ---------------->
        <link rel="stylesheet" href="css/super-admin-inventory.css">
        <link rel="stylesheet" href="css/admin-mainstyle.css">
        <script src="js/admin-inventory.js"></script>

        <!---------------
              FONTS
        ---------------->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gStatic.com" crossorigin>
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
            <a href="super-admin-analytics.php"><img src="Images/MGWR PC Logo.png" alt="" class="logo"></a>

            <input type="checkbox" id="check">
            <label for="check" class="icons">
                <img src="Images/Menu.png" alt="" id="menu-icon">
                <img src="Images/MenuX.png" alt="" id="close-icon">
            </label>

            <nav class="navbar">
                <a href="super-admin-analytics.php" style="--i:0">Analytics</a>
                <a class="active" href="super-admin-inventory.php" style="--i:1">Inventory</a>
                <a href="super-admin-inbox.php" style="--i:4">Inbox</a>
            </nav>
        </header> 

        <!---------------
             TABLES
        ---------------->
        <div class="container-main">
            <div class="container1">
                <main class="table" id="customers_table">

                    <!---------------
                        INVENTORY
                    ---------------->
                    <section class="table__header">
                        <h2>REQUESTS</h2>
                    </section>
                    <section class="table__body">
                        <table id="inventoryTable" class="sticky-header">
                            <thead>
                                <tr>
                                    <th> REQUEST </th>
                                    <th> PRODUCT ID </th>
                                    <th> PRODUCT NAME </th>
                                    <th> IMAGE </th>
                                    <th><button type="button" id="sortTotalUnitsButton">TOTAL UNITS</button></th>
                                    <th> RESERVED UNITS </th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include 'PHP/con_db.php';
                                    $sql = "SELECT * FROM inv_confirm";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr data-id='" . htmlspecialchars($row['id']) . "'>";
                                            echo "<td>" . htmlspecialchars($row['Stat']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['products_id']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['products_name']) . "</td>";
                                            echo "<td><div class='image-container'><img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' alt='Product Image'></div></td>";
                                            echo "<td>" . htmlspecialchars($row['total_units']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['reserved_units']) . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr id='noRequestsRow'><td colspan='8'>No requests found.</td></tr>";
                                    }

                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </section>
                </main>
            </div>
        </div>

        <!--------
            JS
        -------->
        <script>
            function handleRequest(id, action) {
                if (confirm('Are you sure you want to ' + action + ' this request?')) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'PHP/Confirm-reject-inventory.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            alert(xhr.responseText);
                            location.reload();
                        } else {
                            alert('Request failed. Returned status of ' + xhr.status);
                        }
                    };

                    xhr.send('id=' + id + '&action=' + action);
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const noRequestsRow = document.querySelector('#noRequestsRow');
                if (noRequestsRow) {
                    console.log('No requests found.');
                    return;
                }

                const rows = document.querySelectorAll('#inventoryTable tbody tr');
                rows.forEach(row => {
                    const id = row.getAttribute('data-id');

                    const confirmButton = document.createElement('button');
                    confirmButton.className = 'status post';
                    confirmButton.textContent = 'Confirm';
                    confirmButton.onclick = function() { handleRequest(id, 'confirm'); };

                    const rejectButton = document.createElement('button');
                    rejectButton.className = 'status delete';
                    rejectButton.textContent = 'Reject';
                    rejectButton.onclick = function() { handleRequest(id, 'reject'); };

                    const actionCell1 = document.createElement('td');
                    actionCell1.appendChild(confirmButton);

                    const actionCell2 = document.createElement('td');
                    actionCell2.appendChild(rejectButton);

                    row.appendChild(actionCell1);
                    row.appendChild(actionCell2);
                });
            });
        </script>
    </body>
</html>
