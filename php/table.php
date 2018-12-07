<?php
include_once("connection.php");

$tbl_users = "CREATE TABLE IF NOT EXISTS users (
               id INT(5) NOT NULL AUTO_INCREMENT,
			   username VARCHAR(16) NOT NULL,
               fname VARCHAR(12) NOT NULL,
               lname VARCHAR(20) NOT NULL,
               password VARCHAR(255) NOT NULL,
               age INT(2) NOT NULL,
               gender ENUM('m','f','o') NOT NULL,
               location VARCHAR(255) NOT NULL,
               avatar VARCHAR(255) NOT NULL,
               PRIMARY KEY (id),
               UNIQUE KEY username (username)
            )";

$tbl_scores = "CREATE TABLE IF NOT EXISTS scores (
               id INT(5) NOT NULL AUTO_INCREMENT,
               username VARCHAR(255) NOT NULL,
               levelsize INT(10) NOT NULL,
               levelname VARCHAR(10) NOT NULL,
               duration INT(4) NOT NULL,
               score INT(3) NOT NULL,
               errors INT(3) NOT NULL,
               PRIMARY KEY (id)
            )";

$tbl_levels = "CREATE TABLE IF NOT EXISTS levels (
               id INT(5) NOT NULL AUTO_INCREMENT,
               levelsize INT(10) NOT NULL,
               levelname VARCHAR(10) NOT NULL,
               position VARCHAR(10000) NOT NULL,
               PRIMARY KEY (id)
            )";

$query = $conn->query($tbl_users);
if ($query === TRUE) {
	echo "<h3>user table created</h3>"; 
} else {
	echo "<h3>user table NOT created</h3>"; 
}

$query = $conn->query($tbl_scores);
if ($query === TRUE) {
	echo "<h3>score table created</h3>"; 
} else {
	echo "<h3>score table NOT created</h3>"; 
}

$query = $conn->query($tbl_levels);
if ($query === TRUE) {
	echo "<h3>level table created</h3>"; 
} else {
	echo "<h3>level table NOT created</h3>"; 
}

for ($n = 0; $n <= 19; $n++) { //generates levels
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

for ($n = 0; $n <= 19; $n++) { // generate scores (might be impossible to obtain normally)
    for ($m = 1; $m <= 10; $m++) {
        for ($i = 1; $i <= 5; $i++) {
            $score = mt_rand(0,101)/100;
            $duration = mt_rand(0,61);
            $errors = mt_rand(0,3);
            $userVal = mt_rand(0,30);
            if ($userVal >= 1 && $userVal < 10) {
                $user = 'UserOne';
            }
            if ($userVal >= 11 && $userVal < 20) {
                $user = 'UserTwo';
            }
            if ($userVal >= 21 && $userVal < 30) {
                $user = 'UserThree';
            }
            else {
                $user = 'UserOne';
            }
            $n++;
            $new_score = "INSERT INTO scores (username,levelsize,levelname,duration,score,errors) VALUES ('$user','$n','$m','$duration', '$score', '$errors');";
            $result = $conn->query($new_score);
            $n--;
        }
    }
  }

//generate 3 users
$hashpass = password_hash('123', PASSWORD_DEFAULT); 
$new_user = "INSERT INTO users (username,fname,lname,password,age,gender,location,avatar) VALUES ('UserOne', 'UserOne', 'NameOne', '$hashpass','1', 'm', 'fresno', '1.png');";
$result = $conn->query($new_user);

$hashpass = password_hash('456', PASSWORD_DEFAULT);
$new_user = "INSERT INTO users (username,fname,lname,password,age,gender,location,avatar) VALUES ('UserTwo', 'UserTwo', 'NameTwo', '$hashpass','2', 'f', 'clovis', '2.png');";
$result = $conn->query($new_user);

$hashpass = password_hash('789', PASSWORD_DEFAULT);
$new_user = "INSERT INTO users (username,fname,lname,password,age,gender,location,avatar) VALUES ('UserThree', 'UserThree', 'NameThree', '$hashpass','3', 'o', 'clovis', '3.png');";
$result = $conn->query($new_user);





$conn->close();

?>