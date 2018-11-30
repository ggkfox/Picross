<?php
include_once("connection.php");



for ($n = 0; $n <= 19; $n++) {
    $position0 = array(array());
    for ($m = 1; $m <= 10; $m++) {
        for ($i = 0; $i <= $n; $i++) {
            for ($j = 0; $j <= $n; $j++) {
                $position0[$i][$j] = floor(mt_rand(0,10)%2);
            }   
        }
    $position = json_encode($position0);
    $n++;
    $new_level = "INSERT INTO levels (levelsize,levelname,position) VALUES ('$n','$m','$position');";
    $result = $conn->query($new_level);
    $n--;
    }
}

$conn->close();

?>
