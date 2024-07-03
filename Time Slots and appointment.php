<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
 
include("connection.php");

function getTimeSlotsForLoggedInCounselor() {
  global $conn;

  
  $counsellorID = $_SESSION['Counsellor_ID'];

  $query = "SELECT a.*, CONCAT(u.First_Name, ' ', u.Last_Name) AS FullName,
            TIMESTAMPDIFF(YEAR, u.DOB, CURDATE()) AS Age,
            CONCAT(c.Date, '    ', c.Start_Time, ' -   ', c.End_Time) AS Requested_Time_Slot,
            u.Mental_Status, u.Matter
            FROM appointment AS a
            INNER JOIN user AS u ON a.User_ID = u.User_ID
            INNER JOIN counselor_timeslots AS c ON a.Timeslot_ID = c.Timeslot_ID
            WHERE a.Counsellor_ID = ? AND a.Accepted_Status ='0'";
  
  /*$result = mysqli_query($conn, $query);

  if (!$result) {
    // Query execution failed, display the error message
    die("Query failed: " . mysqli_error($conn));
  }

  $timeSlots = array();

  while ($row = mysqli_fetch_assoc($result)) {
    $timeSlots[] = $row;
  }

  return $timeSlots;
}*/


$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {

  die("Statement preparation failed: " . mysqli_error($conn));
}


mysqli_stmt_bind_param($stmt, "s", $counsellorID);


$result = mysqli_stmt_execute($stmt);

if (!$result) {
 
  die("Query failed: " . mysqli_error($conn));
}


$resultSet = mysqli_stmt_get_result($stmt);

$timeSlots = array();

while ($row = mysqli_fetch_assoc($resultSet)) {
  $timeSlots[] = $row;
}

return $timeSlots;
}








if (!isset($_SESSION['Counsellor_ID'])) {

  header('Location: login.php'); 
  exit();
}

$timeSlots = getTimeSlotsForLoggedInCounselor();



?>








<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment Requests and Available Time Slots</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      margin: 20px;
      background-color: peachpuff;
    }

    h1 {
      color: #333;
    }

    .tab-container {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      margin-bottom: 20px;
    }

    .tab {
      display: none;
    }

    .tab.active {
      display: block;
    }

    .tab-buttons {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      margin-left: 96px;
      margin-bottom: 20px;
    }

    .tab-button {
      background-color: #007BFF;
      color: #fff;
      padding: 15px 30px;
      font-size: medium;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      margin-bottom: 5px;
    }

    .tab-button:hover {
      background-color: #0056b3;
    }

    table {
      width: 130%;
      border-collapse: collapse;
      margin-left: 150px;
      margin-bottom: 20px;
      background-color: lightskyblue;
    }

    th, td {
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .delete-button {
      background-color: #dc3545;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }

    .delete-button:hover {
      background-color: #c82333;
    }

    .add-row-button {
      background-color: #28a745;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      padding: 5px 5px;
      margin-right: 10px;
    }

    .add-row-button:hover,
    #save-button:hover {
      background-color: #218838;
    }
  </style>
</head>

<body>
  <h1>Appointments</h1>

  <div class="tab-container">
    <div class="tab-buttons">
      <button class="tab-button" onclick="openTab('appointmentRequests')">Appointment Requests</button>
      <button class="tab-button" onclick="openTab('availableTimeSlots')">Available Time Slots</button>
    </div>

  
        <div class="tab" id="appointmentRequests">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Age</th>
          <th>Mental Status</th>
          <th>Matter</th>
          <th>Requested Time Slot</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($timeSlots as $timeSlot) { ?>
          <tr>
            <td><?php echo $timeSlot['FullName']; ?></td>
            <td><?php echo $timeSlot['Age']; ?></td>
            <td><?php echo $timeSlot['Mental_Status']; ?></td>
            <td><?php echo $timeSlot['Matter']; ?></td>
            <td><?php echo $timeSlot['Requested_Time_Slot']; ?></td>
            <td>
              <button class="delete-button" onclick="deleteRow(this)">Delete</button>
          <button onclick="acceptAppointment(<?php echo $timeSlot['Appointment_ID']; ?>,<?php echo $timeSlot['Timeslot_ID']; ?>)">Accept</button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
          
        </thead>
        <tbody>
            

    <!-- Inside the "Available Time Slots" tab -->
<div class="tab" id="availableTimeSlots">
  <form action="time-slots.php" method="POST">
  <table id="timeSlotsTable">
    <thead>
      <tr>
        <th>Date</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>


    
      <tr>
        <td><input type="date" class="date-input" name="date[]" /></td>
        <td>
          <input type="time" class="start-time-input" name="start_time[]" />
         
        </td>
        <td>
          <input type="time" class="end-time-input" name="end_time[]" />
          
        </td>
        <td>
          <button class="delete-button" onclick="deleteRow(this)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
  <button class="add-row-button" onclick="addRow()" >Add Time Slot</button>
  
  <button id="save-button" type="submit" onclick="saveTimeSlots()" name="save">Save</button>
  </form>
</div>

  <script>
    function openTab(tabName) {
      const tabs = document.querySelectorAll('.tab');
      tabs.forEach(tab => {
        if (tab.id === tabName) {
          tab.classList.add('active');
        } else {
          tab.classList.remove('active');
        }
      });
    }

    function deleteRow(button) {
      const row = button.parentElement.parentElement;
      row.remove();
    }

    function addRow() {
  const table = document.getElementById('timeSlotsTable');
  const newRow = table.insertRow();
  newRow.innerHTML = `
    <td><input type="date" class="date-input" /></td>
    <td><input type="time" class="start-time-input" /></td>
    <td><input type="time" class="end-time-input" /></td>
    <td>
      <button class="delete-button" onclick="deleteRow(this)">Delete</button>
    </td>
  `;
}

function saveTimeSlots() {
  const table = document.getElementById('timeSlotsTable');
  const timeSlotRows = table.getElementsByTagName('tr');

  // Create an array to store the time slot data
  const timeSlotsData = [];

  // Start from index 1 to skip the header row
  for (let i = 1; i < timeSlotRows.length; i++) {
    const row = timeSlotRows[i];
    const dateInput = row.querySelector('.date-input');
    const startTimeInput = row.querySelector('.start-time-input');
    const endTimeInput = row.querySelector('.end-time-input');

    const dateValue = dateInput.value;
    const startTimeValue = startTimeInput.value;
    const endTimeValue = endTimeInput.value;

    // Create an object to represent each time slot
    const timeSlot = {
      date: dateValue,
      startTime: startTimeValue,
      endTime: endTimeValue,
    };

    // Add the time slot object to the data array
    timeSlotsData.push(timeSlot);
  }

  // Display the time slot data (you can modify this to save/send the data to a server)
  console.log(timeSlotsData);
}




  function acceptAppointment(appointmentID,timeslotID) {
    // Make an AJAX call to update the accepts status in the appointment table
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update_appointment_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // The status was updated successfully
          alert("Appointment placed successfully!");
          // You can show a success message or refresh the table to reflect the change
          console.log("Appointment accepted successfully!");
        } else {
          // Some error occurred while updating the status
          alert("Error accepting the appointment.");
          console.log("Error accepting the appointment.");
        }
      }
    };
    xhr.send("appointmentID=" + appointmentID);
  }


  function updateTimeslotAvailability(timeslotID) {
    // Make an AJAX call to update the availability in the counsellor_timeslots table
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "update-timeslot-availability.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // The availability was updated successfully
          console.log("Timeslot availability updated to 'taken'.");
        } else {
          // Some error occurred while updating the availability
          console.log("Error updating timeslot availability.");
        }
      }
    };
    xhr.send("timeslotID=" + timeslotID);
  }
</script>

</body>

</html>

