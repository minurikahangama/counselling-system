<?php
include("1connection.php");
session_start();

if (isset($_POST["submit"])) {
    $currentPassword = $_POST["currentpassword"];
    $newPassword = $_POST["newpassword"];
    $confirmPassword = $_POST["confirmpassword"];

    
    $email = $_SESSION["email"];
    $checkPasswordQuery = "SELECT Pass, ConfirmPassword FROM sign_up WHERE Email = '$email'";
    $result = $conn->query($checkPasswordQuery);


    if (!$result) {
        echo "Error executing query: " ;
    } elseif ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $PassDB = $row["Pass"];

        if ($newPassword === $confirmPassword) {   
            $updateQuery = "UPDATE sign_up SET Pass = '$newPassword' WHERE Email = '$email'";
              
            if ($conn->query($updateQuery) === TRUE) {
                echo "Password changed successfully.";
            } else {
                echo "Error updating password: " ;
            }
        } else {
            echo "Current password is incorrect or new password and confirm password do not match.";
        }
    } else {
        echo "No user found with the provided email.";
    }
}
?>
