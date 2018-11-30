<?php
include_once("connection.php");

$size = (isset($_GET["size"])) ? $_GET["size"] : '0';
$levelname = (isset($_GET["levelname"])) ? $_GET["levelname"] : '0';
$sort = (isset($_GET["sort"])) ? $_GET["sort"] : '0';
$asc = (isset($_GET["asc"])) ? $_GET["asc"] : '0';

if ($asc == 0 && $sort == 0) {
    $sort_levels = "SELECT * FROM scores WHERE levelname = '$levelname' AND levelSize='$size' ORDER BY score ASC, duration ASC;";
    $result = $conn->query($sort_levels);
}
else if ($asc == 1 && $sort == 0){
    $sort_levels = "SELECT * FROM scores WHERE levelname = '$levelname' AND levelSize='$size' ORDER BY score DESC, duration ASC;";
    $result = $conn->query($sort_levels);
}
else if ($asc == 0 && $sort == 1){
    $sort_levels = "SELECT * FROM scores WHERE levelname = '$levelname' AND levelSize='$size' ORDER BY duration ASC, score DESC;";
    $result = $conn->query($sort_levels);
}
else if ($asc == 1 && $sort == 1){
    $sort_levels = "SELECT * FROM scores WHERE levelname = '$levelname' AND levelSize='$size' ORDER BY duration DESC, score DESC;";
    $result = $conn->query($sort_levels);
}
else {
    echo "<h3>Sort and Asc not bound</h3>";
}

$msg = "<table><tr><td>Username</td><td>Score</td><td>Errors</td><td>Duration</td></tr>";

for ($i = 0; $i < 5; $i++) {
    if ($row = $result->fetch_assoc()) {
        $msg = $msg . "<tr>";
        $msg = $msg . "<td>" . $row['username'] . "</td>";
        $msg = $msg . "<td>" . $row['score'] . "</td>";
        $msg = $msg . "<td>" . $row['errors'] . "</td>";
        $msg = $msg . "<td>" . $row['duration'] . "</td>";
        $msg = $msg . "</tr>";
    }
} 

$msg = $msg . "</table>";

echo json_encode($msg);

$conn->close();

?>