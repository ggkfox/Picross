<?php

if (isset($_POST['register-submit'])) {
    include_once("connection.php");

    if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["age"]) && isset($_POST["gender"]) && isset($_POST["username"]) && isset($_POST["password-verify"]) && isset($_POST["password"]) && isset($_POST["location"])) {

        $errorMsg = "";
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $username = $_POST["username"];
        $gender = $_POST["gender"];
        $age = $_POST["age"];
        $location = $_POST["location"];

        if($_POST["password-verify"] == $_POST["password"]) {
            $password = $_POST["password"];
        }
        else {
            $errorMsg = $errorMsg . "Password doesnt match ";
        }

        if(!preg_match('/^[a-zA-z]*$/', $fname)) {
            $errorMsg = $errorMsg . " Invalid First Name ";
        }
        if(!preg_match('/^[a-zA-z]*$/', $lname)) {
            $errorMsg = $errorMsg . " Invalid Last Name ";
        }
        if(!preg_match('/^[a-zA-z]*$/', $age)) {
            $errorMsg = $errorMsg . " Invalid Age ";
        }
        if(!preg_match('/^[a-zA-z]*$/', $location)) {
            $errorMsg = $errorMsg . " Invalid City ";
        }

        if(preg_match("/^[a-zA-z0-9]*$/", $username)) {
            $sql = "SELECT * FROM users WHERE username =?;";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $sql)) {
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
            $sql = "INSERT INTO users (username, fname, lname, password, age, gender, location, avatar) VALUES (?,?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $errorMsg = $errorMsg . " SQL error ";
            }
            else {
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($_FILES["avatar"]["name"]);

                $uploadOk = 1;

                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                $check = getimagesize($_FILES["avatar"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                    $errorMsg = $errorMsg . " File not valid ";
                    header("Location: ../title.php?error=".$errorMsg);
                }
                if (file_exists($target_file)) {
                    $uploadOk = 0;
                    $errorMsg = $errorMsg . " File Exists ";
                    header("Location: ../title.php?error=".$errorMsg);
                }   
                if ($_FILES["avatar"]["size"] > 1000000) {
                    $uploadOk = 0;
                    $errorMsg = $errorMsg . " File too large ";
                    header("Location: ../title.php?error=".$errorMsg);
                }
                if($imageFileType != "jpg" && $imageFileType != "png") {
                    $uploadOk = 0;
                    $errorMsg = $errorMsg . " File not jpg/png ";
                    header("Location: ../title.php?error=".$errorMsg);
                }
                if ($uploadOk == 0) {
                    $errorMsg = $errorMsg . " File not valid ";
                    header("Location: ../title.php?error=".$errorMsg);
                } 
                else {
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                        $hashpass = password_hash($password, PASSWORD_DEFAULT);
                        $avatar = $_FILES["avatar"]["name"];
                        mysqli_stmt_bind_param($stmt, "sssssss", $username, $fname, $lname, $hashpass, $age, $gender, $location, $avatar);
                        mysqli_stmt_execute($stmt);
        
                        header("Location: ../title.php?signup=Account Created");
                    } else {
                        $errorMsg = $errorMsg . " File didnt upload ";
                        header("Location: ../title.php?error=".$errorMsg);
                    }
                }
            }
        }
        else {
            header("Location: ../title.php?error=".$errorMsg);
        }
     }
     else {
        $errorMsg = "Empty Field";
        header("Location: ../title.php?error=".$errorMsg);
    }
}
else {
    header("Location: ../title.php");
}