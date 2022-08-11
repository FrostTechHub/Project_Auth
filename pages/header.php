<?php 
    session_start();
    if ((isset($_SESSION["username"])) and (isset($_SESSION["password"])) and (isset($_SESSION["account_type"]))) {
        $message = "Hello ".$_SESSION["username"]."!";
    } else {
        $message = "Please Create An Account In The Home Page!";
    }
?>