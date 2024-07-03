<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = 'PhotoUpload/'; 
    $targetFile = $targetDir . basename($_FILES['profile_picture']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES['profile_picture']['tmp_name']);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    
    if ($_FILES['profile_picture']['size'] > 5000000) {
        echo "File is too large.";
        $uploadOk = 0;
    }

    
    if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } 
    else {
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile)) {
            $_SESSION['uploaded_photo'] = basename($targetFile);
            echo "Profile picture uploaded successfully.";
        } else {
            echo "Error uploading file.";
        }
    }
}
?>
