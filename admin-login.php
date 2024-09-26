<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!---------------
               PHP
        ---------------->
        <?php
            
            @include 'PHP/admin-login.php';
        ?>
    
        <!---------------
               TAB
        ---------------->
        <title>MGWR PC | Login Page</title>
        <link rel="icon" href="Images/Tab Icon.png" type="image/x-icon">
        
        <!---------------
             CSS & JS
        ---------------->
        <link rel="stylesheet" href="css/mainstyle.css">
        <link rel="stylesheet" href="css/admin-login.css">
        <script src="js/admin-login-security.js"></script>
        
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
        <form method="POST" >
            <div class="page">
                <div class="login-card">
                    <div class="login">
                        <a href="index.php"><img src="Images/MGWR PC Logo.png" alt="" class="logo"></a>
                        <p class="login__subtitle">Welcome back!</p>
    
                        <form class="login-form" id="loginForm">
                            <label for="email"
                                class="input-label login-form__input-label">Username
                            </label>
                            <input id="email" name="admin_username" type="text" class="input-field login-form__email-input" placeholder="Enter Your Username" required/>
    
                            <label for="password"
                                class="input-label login-form__input-label">Password
                            </label>
                            <input id="password" name="admin_password" type="password" class="input-field login-form__password-input" placeholder="Enter Your Password" required/>
    
                            <button type="submit"
                                class="button login-form__submit-button">Sign in
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>