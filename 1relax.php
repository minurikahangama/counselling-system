<?php
session_start();

include("1connection.php");

$userEmail = $_SESSION['email'];

if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit();
}

if (isset($_POST['save'])) {
 
  $catergory = $_POST['catergory'];
  $matter = $_POST['matter'];

  
  $updateQuery = "UPDATE user SET Mental_Catergory = '$catergory', Matter = '$matter' WHERE Email = '$userEmail'";

  
  if (mysqli_query($conn, $updateQuery)) {
    echo "Form data saved successfully!";
    
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>