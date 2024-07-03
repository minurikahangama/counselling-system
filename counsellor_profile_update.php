<?php
include("1connection.php");
session_start();

if(isset($_POST['submit'])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $phone = $_POST["phone"];
    //$email = $_POST["email"];
    $address = $_POST["address"];
    $bio = $_POST["bio"];

    $email=$_SESSION['email'];

    $counsellor_id = $_SESSION["Counsellor_ID"];

    
    $sql = "UPDATE counsellor SET First_name=?, Last_name=?, Contact=?,  Addres=?, Bio=? WHERE Counsellor_ID=? AND Email='$email'";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $firstname, $lastname, $phone, $address, $bio, $counsellor_id);

    if ($stmt->execute()) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
