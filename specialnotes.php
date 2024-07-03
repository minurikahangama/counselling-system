<?php
include("connection.php");

if (isset($_POST['save_btn'])) {
    
    $user_ids = $_POST['user_id'];
    $appointment_ids = $_POST['appointment_id'];
    $special_notes = $_POST['special_notes'];

    for ($i = 0; $i < count($user_ids); $i++) {
        $user_id = $user_ids[$i];
        $appointment_id = $appointment_ids[$i];
        $notes = $special_notes[$i];

        
        $update_sql = "UPDATE appointment SET Notes = ? WHERE User_ID = ? AND Appointment_ID = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssi", $notes, $user_id, $appointment_id);
        $stmt->execute();
      
    }
        if($update_sql){
            echo "Data recorded successfully";

        }
        else {
            echo "Error occured.Try again";

        }
    
}

if (isset($_POST['complete_btn'])) {
    $user_ids = $_POST['user_id'];

    foreach ($user_ids as $user_id) {
        
        $update_sql = "UPDATE appointment SET Status = 1 WHERE Appointment_ID = ?";
        
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        
    }
}

// Redirect back to the schedule page after processing
//header("Location: Counsellor-Schedules.php");
//exit();
?>