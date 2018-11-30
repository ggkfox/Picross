<?php
include_once("connection.php");

$username = (isset($_GET["username"])) ? $_GET["username"] : '0';
$size = (isset($_GET["size"])) ? $_GET["size"] : '0';
$levelname = (isset($_GET["levelname"])) ? $_GET["levelname"] : '0';
$duration = (isset($_GET["duration"])) ? $_GET["duration"] : '0';
$score = (isset($_GET["score"])) ? $_GET["score"] : '0';
$errors = (isset($_GET["errors"])) ? $_GET["errors"] : '0';

$new_score = "INSERT INTO scores (username,levelsize,levelname,duration,score,errors) VALUES ('$username','$size','$levelname','$duration','$score','$errors');";
$result = $conn->query($new_score);

$conn->close();
?>
