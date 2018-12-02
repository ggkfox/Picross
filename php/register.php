<?php

if (isset($_POST['register-submit'])) {
    include_once("connection.php");

    if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["gender"]) && isset($_POST["username"]) && isset($_POST["avatar"]) && isset($_POST["password-verify"]) && isset($_POST["password"]) && isset($_POST["location"])) {

        $errorMsg = "";
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $username = $_POST["username"];
        $avatar = $_POST["avatar"];
        $gender = $_POST["gender"];
        $location = $_POST["location"];

        if($_POST["password-verify"] == $_POST["password"]) {
            $password = $_POST["password"];
        }
        else {
            $errorMsg = $errorMsg . "Password doesnt match ";
        }

        if(preg_match('/^[a-zA-z]*$/', $fname)) {
            $errorMsg = $errorMsg . " Invalid First Name ";
        }
        if(preg_match('/^[a-zA-z]*$/', $lname)) {
            $errorMsg = $errorMsg . " Invalid Last Name ";
        }
        if(preg_match('/^[a-zA-z]*$/', $location)) {
            $errorMsg = $errorMsg . " Invalid City ";
        }

        if(preg_match("/^[a-zA-z0-9]*$/", $username)) {
            $sql = "SELECT * FROM users WHERE username =?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $errorMsg = $errorMsg . " SQL error ";
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if ($resultCheck > 0) {
                    $errorMsg = $errorMsg . " Username taken ";
                }
            }
        }
        else {
            $errorMsg = $errorMsg . " Username not allowed ";
        }

        if ($errorMsg != "") {
            $sql = "INSERT INTO users (username, fname, lname, password, gender, location, avatar) VALUES (?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $errorMsg = $errorMsg . " SQL error ";
            }
            else {
                $hashpass = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "sssssss", $username, $fname, $lname, $hashpass, $gender, $location, $avatar);
                mysqli_stmt_execute($stmt);
                header("Location: ../title.html?signup=success");
            }
        }
        else {
            header("Location: ../title.html?error=".$errorMsg);
        }
     }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../title.html");
}

//echo $fname . " " . $lname . " " . $username . " " . $avatar . " " . $gender . " " . $password;