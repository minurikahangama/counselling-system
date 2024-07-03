<?php
if (isset($_GET['counselorId'])) {
    $counselorId = $_GET['counselorId'];

    // Perform a database query to fetch time slots for the selected counselor
    // Ensure you select only the relevant data and filter by Availability_Status
    $query = "SELECT date, time FROM timeslots WHERE Counsellor_ID = '$counselorId' AND Availability_Status = 'available'";

    // Execute the query and fetch the results
    $result = mysqli_query($conn, $query);

    $timeSlots = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $timeSlots[] = $row;
    }

    // Convert the result to JSON format
    $jsonResponse = json_encode($timeSlots);

    // Return the JSON response
    header('Content-Type: application/json');
    echo $jsonResponse;
}
?>
