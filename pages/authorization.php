<?php include "../pages/header.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style><?php include "../assets/styles.css";?></style>
        <title>Authorization Page</title>
    </head>
    <body>
    <div id="project_logo">
            <img src="../assets/project_auth_logo.png" alt="Project Auth Logo">
    </div>
    <div class="main_nav_bar">
            <ul>
                <li><a href="../pages/home.php">Home</a></li>
                <li><a href="../pages/about.php">About</a></li>
                <li><a href="../pages/authorization.php" class="active">Authorization</a></li>
                <li><a href="../pages/authentication_home.php">Authentication</a></li>
            </ul>
        </div>
        <br>
        <?php
            echo "<h2>Result:</h2>";
            echo $message;
            echo "<br>";
        ?>
    </body>
</html>