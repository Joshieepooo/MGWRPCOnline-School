<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <!---------------
               PHP
        ---------------->
       <?php
            include 'PHP/checker.php';
            ?>
        
        <!---------------
              TAB
        ---------------->
        <title>MGWR PC | Feedbacks</title>
        <link rel="icon" href="Images/Tab Icon.png" type="Images/x-icon">
    
        <!---------------
            CSS & JS
        ---------------->
        <link rel="stylesheet" href="css/mainstyle.css">
        <link rel="stylesheet" href="css/admin-feedback.css">
        <script src="js/mainscript.js"></script>
        <script src="js/admin-feedback.js"></script>
    
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
                <a href="admin-cms.php" style="--i:2">CMS</a>
                <a class="active" href="admin-feedback.php" style="--i:0">Feedback</a>
                <a href="admin-contact-us.php" style="--i:4">Inbox</a>
            </nav>
        </header> 
    
    
    
        <!---------------
              TABLES
        ---------------->
        <main class="table" id="customers_table">
            <section class="table__header">
                <h1>Customer's Feedback</h1>
            </section>
    
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Feedback</th>
                            <th>Rating</th>
                            <th>Tags</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                        
                    <tbody class="center-align">
                        <?php
                            function generateStars($rating) {
                                $stars = "";
                                $rating = floatval($rating);
                                for ($i = 0; $i < $rating; $i++) {
                                    $stars .= "<i class='bx bxs-star' style='font-size: 26px; color: yellow; filter: drop-shadow(0 0 3px rgba(0, 0, 0, 1))'></i>";
                                }
                                if ($rating - floor($rating) > 0) {
                                    $stars .= "<i class='bx bxs-star-half' style='font-size: 26px; color: yellow; filter: drop-shadow(0 0 3px rgba(0, 0, 0, 1))'></i>";
                                }
                                for ($i = ceil($rating); $i < 5; $i++) {
                                    $stars .= "<i class='bx bx-star' style='font-size: 26px; color: yellow; filter: drop-shadow(0 0 3px rgba(0, 0, 0, 1))'></i>";
                                }
                                return $stars;
                            }
    
                            function getTagStyle($tag) {
                                $baseStyle =
                                "display: inline-block;
                                padding: 5px 10px;
                                margin: 5px;
                                border-radius: 10px;
                                width: 200px;
                                height: 40px;
                                line-height: 30px;
                                text-align: center;"; 
                                switch($tag) {
                                    case "First Time Buyer":
                                        return $baseStyle . "background-color: #586994; color: black; border: 1px solid black; font-weight: 600; cursor: default;";
                                    case "Regular Customer":
                                        return $baseStyle . "background-color: #7D869C; color: black; border: 1px solid black; font-weight: 600; cursor: default;";
                                    case "Budget Shopper":
                                        return $baseStyle . "background-color: #A2ABAB; color: black; border: 1px solid black; font-weight: 600; cursor: default;";
                                    case "Brand Loyalist":
                                        return $baseStyle . "background-color: #B4C4AE; color: black; border: 1px solid black; font-weight: 600; cursor: default;";
                                    case "Gift Shopper":
                                        return $baseStyle . "background-color: #E5E8B6; color: black; border: 1px solid black; font-weight: 600; cursor: default;";
                                    case "Window Shopper":
                                        return $baseStyle . "background-color: #F7EF81; color: black; border: 1px solid black; font-weight: 600; cursor: default;";
                                    default:
                                        return $baseStyle;
                                }
                            }
    
                            $servername = "127.0.0.1:3306";
                            $username = "u952394252_mgwrpc";
                            $password = "adminMgwrpc1234";
                            $dbname = "u952394252_mgwrpcdtb";
    
                            $conn = new mysqli($servername, $username, $password, $dbname);
    
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
    
                            $sql = "SELECT 
                            id,
                            name,
                            comment,
                            rating,
                            first_time_buyer,
                            regular_customer,
                            budget_shopper,
                            brand_loyalist,
                            gift_shopper,
                            window_shopper
                            FROM customer_product_reviews
                            ORDER BY id DESC"; 
                        
                            $result = $conn->query($sql);
    
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $stars_html = generateStars($row['rating']);
                                    $tags = [];
                                    if ($row['first_time_buyer']) $tags[] = "<span style='" . getTagStyle("First Time Buyer") . "'>First Time Buyer</span>";
                                    if ($row['regular_customer']) $tags[] = "<span style='" . getTagStyle("Regular Customer") . "'>Regular Customer</span>";
                                    if ($row['budget_shopper']) $tags[] = "<span style='" . getTagStyle("Budget Shopper") . "'>Budget Shopper</span>";
                                    if ($row['brand_loyalist']) $tags[] = "<span style='" . getTagStyle("Brand Loyalist") . "'>Brand Loyalist</span>";
                                    if ($row['gift_shopper']) $tags[] = "<span style='" . getTagStyle("Gift Shopper") . "'>Gift Shopper</span>";
                                    if ($row['window_shopper']) $tags[] = "<span style='" . getTagStyle("Window Shopper") . "'>Window Shopper</span>";
                                    $tags_str = implode(" ", $tags);
    
                                    echo "<tr data-review-id='{$row['id']}'>
                                    <td class='center-content'>{$row['name']}</td>
                                    <td class='feedback-cell justify-comment' onclick='toggleFeedback(this)'>
                                        <span class='short-feedback'>" . substr($row['comment'], 0, 50) . "...</span>
                                        <span class='full-feedback' style='display:none;'>{$row['comment']}</span>
                                    </td>
                                    <td class='center-content'>{$stars_html}</td>
                                    <td class='center-content'>{$tags_str}</td>
                                    <td class='center-content'><button class='status post' data-review-id='{$row['id']}'>Post</button></td>
                                    <td class='center-content'><button class='status delete' onclick='deleteFeedback({$row['id']}, this)'>Delete</button></td>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No feedback available</td></tr>";
                            }
                            $conn->close();
                        ?>
                    </tbody>    
                </table>
            </section>
        </main>
    </body>
</html>