<?php include "../pages/header.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style><?php include "../assets/styles.css";?></style>
        <title>Authentication Page</title>
    </head>
    <body>
        <?php
        $username = "";
        $password = "";
        $message = "";

        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = test_input($_POST["username"]);
            $password = test_input($_POST["password"]);

            if (($username == $_SESSION["username"]) and ($password == $_SESSION["password"])){
                $message = "<img src='../assets/password_successful.jpg' />";
            } elseif (($username != $_SESSION["username"]) or ($password != $_SESSION["password"])) {
                $message = "<img src='../assets/password_failed.jpg' />";
            }
        }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
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
                <li><a href="../pages/authentication_certificate.php" class="active">Certificate-Based</a></li>
                <li><a href="../pages/authentication_biometric.php">Biometric-Based</a></li>
            </ul>
        </div>
        <br>
        <div class="authenticate_password">
            <p>Password-based authentication are one of the most commonly used methods of authenticating a person's 
                identity. It is also known for its simplicity and low cost. Enter the username and password you used
                 to register and click submit!</p>
            <br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username"><br><br>
                <label for="password">Password: </label>
                <input type="text" id="password" name="password"><br><br>
                <input type="submit" value="Submit"><br>
            </form>
            <br>
            <?php
                echo "<h2>Result:</h2>";
                echo $message;
            ?>
        </div>
    </body>
</html>