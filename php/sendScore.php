<?php
include_once("connection.php");

$new_score = "INSERT INTO scores (username,levelsize,levelname,duration,score,errors) VALUES ('abc','7','1','100','3','5');";
$result = $conn->query($new_score);

$conn->close();
?>
