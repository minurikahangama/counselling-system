<?php


include ("connection.php");


session_start();
$counsellor_ID = $_SESSION['Counsellor_ID'];


$sql = "SELECT appointment.Appointment_ID, appointment.User_ID,CONCAT(user.First_Name, ' ', user.Last_Name) AS patient_name, counselor_timeslots.Date, counselor_timeslots.Start_Time, counselor_timeslots.End_Time
        FROM appointment
        INNER JOIN user ON appointment.User_ID = user.User_ID
        INNER JOIN counselor_timeslots ON appointment.Timeslot_ID = counselor_timeslots.Timeslot_ID
        WHERE appointment.Counsellor_ID = ? AND appointment.Accepted_Status = 1";


$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error in preparing the SQL query: " );
}
$stmt->bind_param("s", $counsellor_ID);
$stmt->execute();
$result = $stmt->get_result();


$stmt->close();
$conn->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive HTML Table</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;500&display=swap');

* {
    box-sizing: border-box;
}
body{
  background-color: peachpuff;
}
.topic {
  position: absolute;
  top: 0.5in; /* 1 inch from top margin */
  left: 0.5in; /* 1 inch from left margin */
}

body>div{
    min-height: 100vh;
    display: flex;
    font-family: 'Roboto', sans-serif;
}

.table_responsive {
    max-width: 900px;
    /*border: 1px solid #00bcd4;*/
    background-color: #efefef33;
    padding: 5px;
    overflow: auto;
    margin: auto;
    border-radius: 4px;
    padding-top: 1in;
    padding-bottom: 0.5in;
}

table {
    width: 100%;
    font-size: 13px;
    color: #444;
    white-space: nowrap;
    border-collapse: collapse;
}

table>thead {
    background-color: #00bcd4;
    color: #fff;
}

table>thead th {
    padding: 15px;
}

table th,
table td {
    border: 1px solid #00000017;
    padding: 10px 15px;
}

table>tbody>tr>td>img {
    display: inline-block;
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 2px 6px #0003;
}


.action_btn {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.action_btn>a {
    text-decoration: none;
    color: #444;
    background: #fff;
    border: 1px solid;
    display: inline-block;
    padding: 7px 20px;
    font-weight: bold;
    border-radius: 3px;
    transition: 0.3s ease-in-out;
}

.action_btn>a:nth-child(1) {
    border-color: #26a69a;
}

.action_btn>a:nth-child(2) {
    border-color: orange;
}

.action_btn>a:hover {
    box-shadow: 0 3px 8px #0003;
}


table>tbody>tr {
    background-color: #fff;
    transition: 0.3s ease-in-out;
}


table>tbody>tr:nth-child(even) {
    background-color: rgb(238, 238, 238);
}

table>tbody>tr:hover{
    filter: drop-shadow(0px 2px 6px #0002);
}

.save-btn {
        background-color: #26a69a;
        position: fixed;
        bottom: 1in;
        right: 0.5in;
        z-index: 1;
        width: 0.8in;
        height: 0.3in;
    }

    .completed-btn {
        background-color: orange;
    }

    .notes-input {
        height: 80px;
        resize: vertical;
    }
    
    

    /* Styling for the file input */
    .file-input-container {
        position: relative;
    }

    .file-input {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

   
</style>
<body>

<form action= "specialnotes.php" method="post">
  <h1 class="topic">Schedules</h1>
    <div class="table_responsive">
        <table>
          <thead>
            <tr>

           
              <th>Patient Name</th>
              <th>Session Date </th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Special Notes</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody>


          <?php
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["patient_name"] . "</td>";
                    echo "<td>" . $row["Date"] . "</td>";
                    echo "<td>" . $row["Start_Time"] . "</td>";
                    echo "<td>" . $row["End_Time"] . "</td>";
                    echo '<td><textarea name="special_notes[]" class="notes-input" placeholder="Add special notes"></textarea></td>';
                    echo '<td><button type="submit" name="save_btn">Save</button><button type="submit" name="complete_btn">Complete</button></td>';
                    echo '<input type="hidden" name="user_id[]" value="' . $row['User_ID'] . '">';
                
                    if (isset($row['Appointment_ID'])) {
                        echo '<input type="hidden" name="appointment_id[]" value="' . $row['Appointment_ID'] . '">';
                    } else {
                        echo '<input type="hidden" name="appointment_id[]" value="">';
                    }
                    echo "</tr>";
    }  
    
    
                  
                ?>

          
           
        </tbody>
                   
        </table>
      </div>
    </div>
    <div style="position: fixed; bottom: 10px; right: 10px;">
    <!-- <button class="save-btn" onclick="saveData()">Save</button> -->
    </div>
    </form>
  <script>
    // Function to handle the Save button click
    function saveData(userID,appointmentID) {
        const specialNotesInputs = document.querySelectorAll(`textarea[name="special_notes[]"][data-user-id="${userID}"]`).value;
     
        const specialNotes = [];
    specialNotesInputs.forEach(textArea => {
        specialNotes.push(textArea.value);
    });

    // Here, you can perform any action with the collected data
    // For example, you could send it to the server using AJAX

    // Show success message
    alert("Notes saved successfully");


        // Iterate through each row and extract the data
        //const data = [];
       // tableRows.forEach(row => {
               // const userID = row.dataset.userId;
                //const patientName = row.cells[0].innerText;
               // const sessionDate = row.cells[1].innerText;
               // const startTime = row.cells[2].innerText;
                //const endTime = row.cells[3].innerText;
               // const specialNotes = row.querySelector(".notes-input").value;
               // const status = row.cells[4].innerText;
               // data.push({ userID, patientName, sessionDate, startTime, endTime, specialNotes, status });
           // });
        // Here, you can perform any action with the collected data
        // For example, you could send it to the server using AJAX

        // For demonstration purposes, we'll just log the data to the console
        console.log("User ID:", userID);
        console.log("Appointment ID:", appointmentID);
        console.log("Special Notes:", specialNotes);
       }

       function handleCompletedButton(button) {
    const row = button.closest("tr");
    const appointmentID = row.querySelector('input[name="appointment_id[]"]').value;
    row.remove();

    // Show success message
    alert("Appointment completed successfully");

    // Call the function to mark the appointment as complete on the server using AJAX
    completeAppointment(appointmentID);
  }


    function updateNotes(textArea) {
            // Find the parent row
            const row = textArea.closest("tr");
            // Get the user ID from the row's data attribute
            const userID = row.dataset.userId;
            // Get the entered notes
            const specialNotes = textArea.value;
            // Update the data in the frontend (not sending to the server yet)
            // You can perform any other actions needed with this data
            console.log("User ID:", userID);
            console.log("Special Notes:", specialNotes);
        }



        function completeAppointment(appointmentID) {
        // Use AJAX to mark the appointment as complete on the server
        // Perform your AJAX request here
        // You can pass the `appointmentID` to the server to mark it as complete
        console.log("Marking appointment as complete. Appointment ID:", appointmentID);
    }


    
   
    // Add click event listeners to Completed buttons
    const completedButtons = document.querySelectorAll(".completed-btn");
    completedButtons.forEach(button => {
        button.addEventListener("click", () => handleCompletedButton(button));
    });
  /*  function toggleFileInput(button) {
            const fileInput = button.nextElementSibling;
            const textArea = fileInput.previousElementSibling;
            
            if (fileInput.style.display === "none") {
                // Show file input and hide textarea
                fileInput.style.display = "block";
                textArea.style.display = "none";
            } else {
                // Show textarea and hide file input
                fileInput.style.display = "none";
                textArea.style.display = "block";
            }
        }*/

        
</script>
</body>
</html>