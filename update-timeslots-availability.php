<?php
include("connection.php");




if (isset($_POST['timeslotID'])) {
 
  $timeslotID = mysqli_real_escape_string($conn, $_POST['timeslotID']);

  
  $updateQuery = "UPDATE counselor_timeslots SET Availability_Status = 'booked' WHERE Timeslot_ID = $timeslotID";

  $updateResult = mysqli_query($conn, $updateQuery);

  if ($updateResult) {
    
    http_response_code(200);
    echo "Timeslot availability updated to 'booked'.";
  } else {
    
    http_response_code(500);
    echo "Error updating timeslot availability.";
  }
} else {
  
  http_response_code(400);
  echo "Invalid request.";
}
?>