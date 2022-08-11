<?php include "../pages/header.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style><?php include "../assets/styles.css";?></style>
        <title>Authentication Page</title>
    </head>
    <body>
        <div id="project_logo">
            <img src="../assets/project_auth_logo.png" alt="Project Auth Logo">
        </div>
        <div class="main_nav_bar">
            <ul>
                <li><a href="../pages/home.php">Home</a></li>
                <li><a href="../pages/about.php">About</a></li>
                <li><a href="../pages/authorization.php">Authorization</a></li>
                <li><a href="../pages/authentication_home.php" class="active">Authentication</a></li>
            </ul>
        </div>
        <br>
        <div class="authenticate_info">
            <h1>Welcome to the Authentication Page. </h1>
            <p>Authentication is all about ensuring that the user accessing a certain material, application or device is who he/she
                really is and not some creep trying to access it. There are various ways to authenticate someone. Click through the 
                different methods via the panel on the left to experience them for yourself! Happy Exploring!
            </p>
        </div>
        <div class="authenticate_nav_bar">
            <ul>
                <li><a href="../pages/authentication_password.php">Password-Based</a></li>
                <li><a href="../pages/authentication_multi_factor.php">Multi-Factor</a></li>
                <li><a href="../pages/authentication_token.php">Token-Based</a></li>
                <li><a href="../pages/authentication_certificate.php">Certificate-Based</a></li>
                <li><a href="../pages/authentication_biometric.php">Biometric-Based</a></li>
            </ul>
        </div>
    </body>
</html>