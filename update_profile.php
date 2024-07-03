<?php
include("1connection.php");
session_start();

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(isset($_POST['submit'])){
    
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["addres"];
    $bio = $_POST["bio"];

   
    $user_id = $_SESSION["User_ID"];

    
    $sql = "UPDATE user SET First_Name='$firstname', Last_Name='$lastname', Contact='$phone', Email='$email', Addres='$address', Bio='$bio' WHERE User_ID='$user_id'";

    if ($conn->query($sql) === TRUE) {
       
        echo "Profile updated successfully";
    } else {
        
        echo "Error updating profile: ";
    }
}

$conn->close();
?>
