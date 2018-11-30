<?php
include_once("connection.php");

$size = $_GET["size"];

$select_level = "SELECT position FROM levels WHERE levelSize='$size';";
    
$result = $conn->query($select_level);

$row = $result->fetch_assoc();

echo json_encode($row['position']);

$conn->close();
?>