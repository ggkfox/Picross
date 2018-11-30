<?php
include_once("connection.php");

$tbl_users = "CREATE TABLE IF NOT EXISTS users (
              id INT(5) NOT NULL AUTO_INCREMENT,
			        username VARCHAR(16) NOT NULL,
              fname VARCHAR(12) NOT NULL,
              lname VARCHAR(20) NOT NULL,
              password VARCHAR(255) NOT NULL,
              gender ENUM('m','f') NOT NULL,
              location VARCHAR(255) NULL,
              avatar VARCHAR(255) NULL,
              PRIMARY KEY (id),
              UNIQUE KEY username (username)
             )";

$tbl_scores = "CREATE TABLE IF NOT EXISTS scores (
               id INT(11) NOT NULL AUTO_INCREMENT,
               userid INT(5) NOT NULL,
               duration INT(4) NOT NULL,
               errors INT(3) NOT NULL,
               score INT(3) NOT NULL,
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