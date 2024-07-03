<?php

include("1connection.php");
if(isset($_POST['submit'])){
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$nic = $_POST['nic'];
$dob = $_POST['dob'];
$marital_status = $_POST['marital-status'];
$bio = $_POST['bio'];
$education = $_POST['education'];


$sql = "INSERT INTO admin_table (Full_Name, Phone, Email, Gender, NIC, DOB, Maritual_Status, Bio, Qualifications)
        VALUES ('$name', '$phone', '$email', '$gender', '$nic', '$dob', '$marital_status', '$bio', '$education')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" ;
}
}

if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $nic = $_POST['nic'];
    $dob = $_POST['dob'];
    $marital_status = $_POST['marital-status'];
    $bio = $_POST['bio'];
    $education = $_POST['education'];
    
    
    $sql = ("UPDATE admin_table SET Full_Name='$name', Phone='$phone', Email='$email', Gender='$gender', NIC='$nic', DOB='dob', Maritual_Status=' $marital_status', Bio='$bio', Qualifications='$education'");
           
    
    if ($conn->query($sql) === TRUE) {
        echo "Data updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>";
    }
    }

$conn->close();
?>
