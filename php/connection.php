<?php

$servername = "localhost";
$username = "admin";
$password = "123";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);
//test connection
if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error . "<br>");
}
else echo "connection successful.";

?>