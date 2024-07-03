<?php

include("connection.php");
session_start();


if (isset($_SESSION['email']) && isset($_SESSION['Counsellor_ID'])) {
    $email = $_SESSION['email'];
    $counsellor_id = $_SESSION['Counsellor_ID'];
  

    if (isset($_POST['save'])) {
        
        $dates = $_POST['date'];
        $startTimes = $_POST['start_time'];
        $endTimes = $_POST['end_time'];

 
        for ($i = 0; $i < count($dates); $i++) {
            $date = mysqli_real_escape_string($conn, $dates[$i]);
            $startTime = mysqli_real_escape_string($conn, $startTimes[$i]);
            $endTime = mysqli_real_escape_string($conn, $endTimes[$i]);


            $query = "INSERT INTO counselor_timeslots (Counsellor_ID, Date, Start_Time, End_Time) 
                      VALUES ('$counsellor_id', '$date', '$startTime', '$endTime')";

            if (mysqli_query($conn, $query)) {
                echo "Time slot added successfully.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
   else{ 
    header("Location: login.php");
    exit();
}
?>
