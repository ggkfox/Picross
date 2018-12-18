<?php

$target_dir = "../boards/"; // you must create this directory in the folder where you have the PHP file
$target_file = $target_dir . basename($_FILES["fileup"]["name"]);
$new_name = $target_dir . "board1.jpg";
echo $new_name;
$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Verify if the image file is an actual image or a fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileup"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
// Verify if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
}
// Verify the file size
if ($_FILES["fileup"]["size"] > 1000000) {
    $uploadOk = 0;
}
// Verify certain file formats
if($imageFileType != "jpg") {
    $uploadOk = 0;
}
// Verify if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
} else { // upload file
    if (move_uploaded_file($_FILES["fileup"]["tmp_name"], $target_file)) {
        rename($target_file,$new_name);
    }
}

header("Location: ../index.php");
?>