<?php

if (isset($_POST['login-submit'])) {
    include_once("connection.php");

    $username = $_POST["username"];
    $password = $_POST["password"];
    $errorMsg = "";

    if(empty($username) || empty($password)) {
        $errorMsg = $errorMsg . " No username or password ";
        header("Location: ../title.php?error=".$errorMsg);
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE username=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            $errorMsg = $errorMsg . " SQL error ";
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['password']);
                if ($pwdCheck == false) {
                    $errorMsg = $errorMsg . " Wrong Password ";
                }
                else if ($pwdCheck == true){
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['avatar'] = "uploads/". $row['avatar'];
                    header("Location: ../title.php?login=success");
                    exit();
                }
            }
            else {
                $errorMsg = $errorMsg . " Invalid ";
                header("Location: ../title.php?error=".$errorMsg);
                exit();
            }
        }
    }

}

else {
    header("Location: ../title.php");
}