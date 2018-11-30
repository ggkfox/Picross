<?php
include_once("connection.php");

$size = $_GET["size"];
$levelname = $_GET["levelname"];

$select_level = "SELECT position FROM levels WHERE levelname = '$levelname' AND levelSize='$size';";
    
$result = $conn->query($select_level);

$row = $result->fetch_assoc();

echo json_encode($row['position']);

$conn->close();

?>