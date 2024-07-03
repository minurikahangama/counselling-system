<?php

session_start();

$user_id=$_SESSION['User_ID'];

include("1connection.php");

if (isset($_POST['appointmentID'])) {
    $appointmentID = mysqli_real_escape_string($conn, $_POST['appointmentID']);

    $updateQuery = "UPDATE appointment SET Accepted_Status = 1 WHERE Appointment_ID = $appointmentID";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
    
        $getTimeslotIDQuery = "SELECT Timeslot_ID FROM appointment WHERE Appointment_ID = $appointmentID";
        $timeslotResult = mysqli_query($conn, $getTimeslotIDQuery);
        $timeslotData = mysqli_fetch_assoc($timeslotResult);
        $timeslotID = $timeslotData['Timeslot_ID'];

        $updateTimeslotAvailabilityQuery = "UPDATE counselor_timeslots SET Availability_Status = 'booked' WHERE Timeslot_ID = $timeslotID";
        mysqli_query($conn, $updateTimeslotAvailabilityQuery);

        
        $notificationMessage = "Your appointment has been accepted.";
        $insertNotificationQuery = "UPDATE appointment SET  Notification_Message='$notificationMessage', Notification_Status= 'unread', Notification_Time = CURRENT_TIMESTAMP WHERE Appointment_ID = $appointmentID";
        mysqli_query($conn, $insertNotificationQuery);

        http_response_code(200);
        echo "Appointment accepted successfully!";
    } else {
        http_response_code(500);
        echo "Error accepting the appointment.";
    }
} else {
    http_response_code(400);
    echo "Invalid request.";
}


?>