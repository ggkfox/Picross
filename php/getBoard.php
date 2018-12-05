<?php
include_once("connection.php");

$size = (isset($_GET["size"])) ? $_GET["size"] : '0';
$levelname = (isset($_GET["levelname"])) ? $_GET["levelname"] : '0';

$select_level = "SELECT position FROM levels WHERE levelname = '$levelname' AND levelSize='$size';";
    
$result = $conn->query($select_level);

$row = $result->fetch_assoc();

echo json_encode($row['position']);

$conn->close();

?>