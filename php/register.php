<?php

if (isset($_POST['register-submit'])) {
    include_once("connection.php");

    if(isset($_POST["fname"]) && isset($_POST["lname"]) && (isset($_POST["genderm"]) || isset($_POST["genderf"])) && isset($_POST["username"]) && isset($_POST["avatar"]) && isset($_POST["password-verify"]) && isset($_POST["password"])) {
        echo "received";
        /*
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $username = $_POST["username"];
        $avatar = $_POST["avatar"];
        if(isset($_POST["genderm"])) {
            $gender = 'm';
        }
        if(isset($_POST["genderf"])) {
            $gender = 'f';
        }
        if(isset($_POST["password-verify"]) && issset($_POST["password"])) {
            if($_POST["password-verify"] == $_POST["password"]) {
                $password = $_POST["password"];
            }
            else {
                //passwords dont match
            }
        }
        else {
            //passwords not set
        }
    
        */
    }
  

}