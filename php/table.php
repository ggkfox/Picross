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
              PRIMARY KEY (id)
             )";
$query = mysqli_query($conn, $tbl_users);

if ($query === TRUE) {
	echo "<h3>user table created</h3>"; 
} else {
	echo "<h3>user table NOT created</h3>"; 
}

