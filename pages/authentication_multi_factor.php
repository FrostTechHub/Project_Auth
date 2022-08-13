<?php
    include "../pages/header.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    //Initialize Variables
    $username = $password = $message = $user_input_vc = "";
    
    //Form 1 - Verify Username & Passsword
    if (isset($_POST["request_otp"])) {
        $username = test_input($_POST["username"]);
        $password = test_input($_POST["password"]);
        otp_requester($username, $password);
    }
    
    //Form 2 - Verify User Input OTP
    if (isset($_POST["verify_user_otp"])){
        $user_input_vc = $_POST["user_otp"];
        $message = authenticate_user_otp($user_input_vc);
    }

    //Strip special chars from user input
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //One Time Passcode Generator
    function otp_generator(){
        $verification_code = substr(number_format(time() * rand(), 0, "", ""), 0, 6);
        return $verification_code;
    }

    //Process to authenticate user input otp
    function authenticate_user_otp($user_input_vc){
        if ($user_input_vc == $_SESSION["verification_code"]){
            $message = "<img src='../assets/password_successful.jpg' />";
        } else {
            $message = "Incorrect OTP! Please try again!";
        }
        return $message;
    }

    //Process to request for smtp.gmail server to send OTP to user
    function otp_requester($username, $password){
        if (($username == $_SESSION["username"]) and ($password == $_SESSION["password"])){
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            $_SESSION["verification_code"] = otp_generator();

            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'noreply.projectauth@gmail.com';        //SMTP username
                $mail->Password   = 'odpkkbikmckgqclv';                     //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
                //Recipients
                $mail->From = 'noreply.projectauth@gmail.com';
                $mail->FromName = "noreply - Project Auth OTP Generator";
                $mail->addAddress($_SESSION["email_addr"]);
        
                //Content
                $mail->isHTML(true);                                        //Set email format to HTML
                $mail->CharSet = "UTF-8";                                   //Set charset value
                $mail->Encoding = "base64";                                 //Set encoding value
                $mail->Subject = "OTP Verification";
                $mail->Body    = "Please enter your OTP: <b>".$_SESSION["verification_code"]."</b>";
        
                $mail->send();
                echo 'OTP has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        } elseif (($username != $_SESSION["username"]) or ($password != $_SESSION["password"])) {
            $message = "<img src='../assets/password_failed.jpg' />";
        }
    }
?>
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
                <li><a href="../pages/authentication_multi_factor.php" class="active">Multi-Factor</a></li>
                <li><a href="../pages/authentication_token.php">Token-Based</a></li>
                <li><a href="../pages/authentication_certificate.php">Certificate-Based</a></li>
                <li><a href="../pages/authentication_biometric.php">Biometric-Based</a></li>
            </ul>
        </div>
        <br>
        <div class="authenticate_password">
            <p>Multi-Factor authentication uses one or more authentication methods to verify a user's identity. Most common form of
                multi-factor authentication is password-based followed by a One-Time Token (OTP) authentication. There are organizations
                who uses biometric/certificate authentication as another additional security layer when authenticating a user. <br><br> Enter your 
                username & password, click "Submit". Enter the OTP you received via <b>email</b> and click "Log In".
            </p>
            <br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username"><br><br>
                <label for="password">Password: </label>
                <input type="text" id="password" name="password">
                <input type="submit" value="Request OTP" name="request_otp"><br><br>
            </form>
            <br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="OTP"> One-Time Password: </label>
                <input type="text" id="otp" name="user_otp">
                <input type="submit" value="Log In" name="verify_user_otp"><br>
            </form>
            <br>
            <?php
                echo "<h2>Result:</h2>";
                echo $message;
            ?>
        </div>
    </body>
</html>