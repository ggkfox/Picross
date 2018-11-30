<?php
include_once("connection.php");

$size = $_GET["size"];
$levelname = $_GET["levelname"];
$sort = $_GET["sort"];
$asc = $_GET["asc"];

if ($asc == 0 && $sort == 0) {
    $sort_levels = "SELECT * FROM scores WHERE levelname = '$levelname' AND levelSize='$size' ORDER BY score ASC;";
    $result = $conn->query($sort_levels);
}
else if ($asc == 1 && $sort == 0){
    $sort_levels = "SELECT * FROM scores WHERE levelname = '$levelname' AND levelSize='$size' ORDER BY score DESC;";
    $result = $conn->query($sort_levels);
}
else if ($asc == 0 && $sort == 1){
    $sort_levels = "SELECT * FROM scores WHERE levelname = '$levelname' AND levelSize='$size' ORDER BY duration ASC;";
    $result = $conn->query($sort_levels);
}
else if ($asc == 1 && $sort == 1){
    $sort_levels = "SELECT * FROM scores WHERE levelname = '$levelname' AND levelSize='$size' ORDER BY duration DESC;";
    $result = $conn->query($sort_levels);
}
else {
    echo "<h3>Sort and Asc not bound</h3>";
}

$msg = "<table><tr><td>Username</td><td>Score</td><td>Errors</td><td>Duration</td></tr>";
while($row = $result->fetch_assoc()){
    $msg = $msg . "<tr>";
    $msg = $msg . "<td>" . $row['username'] . "</td>";
    $msg = $msg . "<td>" . $row['score'] . "</td>";
    $msg = $msg . "<td>" . $row['errors'] . "</td>";
    $msg = $msg . "<td>" . $row['duration'] . "</td>";
    $msg = $msg . "</tr>";
}
$msg = $msg . "</table>";

echo json_encode($msg);

$conn->close();

?>