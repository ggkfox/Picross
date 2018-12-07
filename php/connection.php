<?php

$servername = "localhost";
$username = "csci130";
$password = "123456";
$dbname = "DB081995";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error . "<br>");
}

?>