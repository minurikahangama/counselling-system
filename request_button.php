<?php


include("1connection.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request'])) {
    $userID = $_POST['userID'];
    $counselorID = $_POST['counselorID'];
    $timeslotID = $_POST['timeslotID'];

   
    $insertQuery = "INSERT INTO appointment (User_ID, Counsellor_ID, Timeslot_ID) VALUES ('$userID', '$counselorID', '$timeslotID')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "Request sent!";

       // header("Location: success_page.php"); 
        //exit;
    } else {
        echo "Error! Request not sent";

       // header("Location: error_page.php"); 
       // exit;
    }
}
?>