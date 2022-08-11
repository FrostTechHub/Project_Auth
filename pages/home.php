<?php include "../pages/header.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style><?php include "../assets/styles.css";?></style>
        <title>Home Page</title>
    </head>
    <body>
    <?php

        //Define variables and set to empty values
        $message = "Account Not Created! Please Create Account!";
        $username = $password = $account_type = $errMsg_username = $errMsg_password = $errMsg_account_type = $errMsg_email = "";

        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Check If Username Input Is Empty
            if (empty($_POST["username"])){
                $errMsg_username = "Enter Username";
            } else {
                //Validate Username
                $username = test_input($_POST["username"]);
            }
            
            //Check If Password Input Is Empty
            if (empty($_POST["password"])){
                $errMsg_password = "Enter Password";
            } else {
                //Validate Password
                $password = test_input($_POST["password"]);
            }
            
            //Check If Email Input Is Empty
            if (empty($_POST["password"])){
                $errMsg_email = "Enter Email Address";
            } else {
                //Validate Email
                if (!filter_var($_POST["email_addr"], FILTER_VALIDATE_EMAIL)) {
                    $errMsg_email = "Invalid Email Format";
                } else {
                    $email_addr = $_POST["email_addr"];
                }
            }
                            
            //Check If Account Type Input Is Empty
            if (empty($_POST["account_type"])){
                $errMsg_account_type = "Select Account Type";
            } else {
                //Validate Account Type
                $account_type = test_input($_POST["account_type"]);
            }
            
            //Setting Session Variables
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            $_SESSION["email_addr"] = $email_addr;
            $_SESSION["account_type"] = $account_type;
            
            //User Confirmation Message
            $message = "Hello ".$_SESSION["username"].". Your Account Is Ready! You May Now Access Learning Resources! Please Note That 
            Your Account Session Will Terminate Once The Browser Is Closed! You Will Need To Create A New Account To Re-Access Learning Resources!";
        }
        
        //Function To Validate User Inputs
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
                <li><a href="../pages/home.php" class="active">Home</a></li>
                <li><a href="../pages/about.php">About</a></li>
                <li><a href="../pages/authorization.php">Authorization</a></li>
                <li><a href="../pages/authentication_home.php">Authentication</a></li>
            </ul>
        </div>
        <br>
        <div class="home_info">
            <p>Hi, Welcome to the home page for Project Auth. To start your experience, 
                please create a enter a username and password in the field. Click Submit to 
                submit your entries.</p>
            <br>
            <div class="registration_form">
                <span class="error">* required field </span>
                <br><br>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <label for="username">Username: </label>
                    <input type="text" id="username" name="username">
                    <span class="error">*<?php echo $errMsg_username?></span><br><br>
                    <label for="password">Password: </label>
                    <input type="text" id="password" name="password">
                    <span class="error">*<?php echo $errMsg_password?></span><br><br>
                    <label for="email_addr">Email: </label>
                    <input type="" id="email_addr" name="email_addr">
                    <span class="error">*<?php echo $errMsg_email?></span><br><br>
                    <label for="account_type">Type: </label>
                    <select name="account_type">
                        <option value="">Select</option>
                        <option value="user">User</option>
                    </select>
                    <span class="error">*<?php echo $errMsg_account_type?></span><br><br>
                    <input type="submit" name="submit">
                </form>
            </div>
            <br>
            <p>Once your account has been created, simply click either Authorization or Authentication
                to learn more about them. You will need your username and password to access certain materials
                and functions of this web app. Good Luck and Happy Learning!
            </p>
            <br>
            <p>P.S. All info will be stored on a cookie that automatically deletes itself once the browser is closed. NO INFO OR CREDENTIALS WILL BE STORED.
                Also, storing login info on a cookie is a bad idea and shouldn't be used on real-world applications. But for the sake of this learning experience
                we'll be using the cookie to temporarily store user credentils.
            </p>
            <br>
            <?php
            if (isset($_POST["submit"])) {
                if ($errMsg_account_type == "" && $errMsg_username == "" && $errMsg_password == ""){
                    echo "<h2>Result:</h2>";
                    echo $message;
                    echo "<br>";
                } else {
                    echo "<h2><b>Form Not Filled Correctly!</b></h2>";
                }
            }
            ?>
        </div>
    </body>
</html>