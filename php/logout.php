<?php

session_start();
 
if (isset($_POST['logout-submit'])) {
    $_SESSION = array();
    session_destroy();
    
    header("Location: ../title.php?logout=Logged Out");
    exit();
}
else {
    header("Location: ../title.php?error=Shouldnt be here");
    exit();
}
?>