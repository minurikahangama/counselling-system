<?php

session_start();


include("connection2.php");
include("1connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["counsellor"])) {
        $counsellorID = $_POST["counsellor"];


        $query = "SELECT * FROM counselor_timeslots WHERE Counsellor_ID = '$counsellorID'";
        $result = mysqli_query($conn, $query);

        $timeslots = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $timeslots[] = $row;
        }
    }
}

$email = $_SESSION['email'];
$user_id = $_SESSION['User_ID'];
$fetchNotificationsQuery = "SELECT * FROM appointment WHERE User_ID = '$user_id' AND Notification_Status = 'unread'";
$notificationsResult = mysqli_query($conn, $fetchNotificationsQuery);

$notifications = [];
if ($notificationsResult) {
    while ($row = mysqli_fetch_assoc($notificationsResult)) {
        $notifications[] = $row;
    }
}

$updateReadQuery = "UPDATE appointment SET Notification_Status = 'read' WHERE User_ID = '$user_id' AND Notification_Status = 'unread'";
mysqli_query($conn, $updateReadQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Booking</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SMILE</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->


                            <!-- Nav Item - Alerts -->
                            li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>

                                <!-- Counter - Alerts -->
                                <?php if (count($notifications) > 0) : ?>
                                    <span class="badge badge-danger badge-counter">
                                        <?php echo count($notifications); ?>
                                    </span>
                                <?php endif; ?>

                            </a>
                            <?php if (count($notifications) > 0) : ?>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <?php foreach ($notifications as $notification) : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500"><?php echo $notification['Notification_Time']; ?></div>
                                                <span class="font-weight-bold"><?php echo $notification['Notification_message']; ?></span>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                </div>
                            <?php endif; ?>
                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $_SESSION['email'] ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">
                    <link rel="stylesheet" href="session.css">
                    <div class="container2">
                        <h1>Session Booking</h1>

                        <label for="counsellor">Select a Counsellor:</label>
                        <select id="counsellor" name="counsellor">
                            <option value="">--Select counsellor--</option>

                            <?php


                            $categoryrs = Database::search("SELECT DISTINCT c.* FROM `counsellor` c
                            INNER JOIN `counselor_timeslots` t ON c.`Counsellor_ID` = t.`Counsellor_ID`
                            WHERE t.Availability_Status='available'");

                            $num = $categoryrs->num_rows;

                            for ($x = 0; $x < $num; $x++) {

                                $cd = $categoryrs->fetch_assoc();

                            ?>

                                <option value="<?php echo $cd['Counsellor_ID']; ?>"> <?php echo $cd["First_name"] . " " .  $cd["Last_name"]; ?></option>

                            <?php





                            }
                            //    echo $cd['Counsellor_ID']  ;

                            $selectedID = $cd['Counsellor_ID'];

                            ?>

                        </select>



                        <div id="timeSlotsTable" style="display: none;">

                            <table>
                                <tr>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Request</th>
                                </tr>

                                <?php

                                $user_id = $_SESSION['User_ID'];


                                $timeslot =  Database::search("SELECT * FROM counselor_timeslots WHERE Counsellor_ID= '" . $selectedID . "'");
                                $pn = $timeslot->num_rows;




                                for ($x = 0; $x < $pn; $x++) {
                                    $t = $timeslot->fetch_assoc();


                                ?>

                                    <tr>
                                        <td> <?php echo $t['Date'] ?></td>
                                        <td><?php echo $t['Start_Time'] ?></td>
                                        <td><?php echo $t['End_Time'] ?></td>
                                        <td>

                                            <form action="request_button.php" method="POST">
                                                <input type="hidden" name="userID" value="<?php echo $user_id; ?>">
                                                <input type="hidden" name="counselorID" value="<?php echo $cd['Counsellor_ID']; ?>">
                                                <input type="hidden" name="timeslotID" value="<?php echo $t['Timeslot_ID']; ?>">
                                                <button type="submit" class="request-button" name="request">Request</button>
                                            </form>
                                        </td>
                                    </tr>

                                <?php

                                } ?>
                                <!-- Time slots will be added here -->
                            </table>
                        </div>
                       <!-- <script src="session.js"></script> -->
                    </div>
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <!--<script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
Core plugin JavaScript-->
        <!--  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

         Custom scripts for all pages-->
       <!-- <script src="js/sb-admin-2.min.js"></script> -->


        <script>
            // alert($cd['Counsellor_ID'])
            function showTimeSlots() {
                const counsellorSelect = document.getElementById('counsellor');
                const timeSlotsTable = document.getElementById('timeSlotsTable');
                timeSlotsTable.style.display = counsellorSelect.value ? 'block' : 'none';

                if (!counsellorSelect.value) return;

                // Fetch timeslots for the selected counselor using AJAX
                fetch('fetch_counsellor_timeslots.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'counsellor=' + encodeURIComponent(counsellorSelect.value)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            const tableBody = timeSlotsTable.querySelector('tbody');
                            if (tableBody) {
                                tableBody.remove();
                            }

                            const tbody = document.createElement('tbody');
                            data.forEach(slot => {
                                const row = document.createElement('tr');
                                const dateCell = document.createElement('td');
                                const timeCell = document.createElement('td');
                                const endtimeCell = document.createElement('td');
                                const requestCell = document.createElement('td');
                                const requestButton = document.createElement('button');

                                dateCell.textContent = slot.Date;
                                timeCell.textContent = slot.Start_Time;
                                endtimeCell.textContent = slot.End_Time;

                                requestButton.textContent = 'Request';
                                requestButton.className = 'request-button';

                                requestButton.onclick = function() {
                                    if (requestButton.classList.contains('request-sent')) {
                                        requestButton.textContent = 'Request';
                                        requestButton.classList.remove('request-sent');
                                    } else {
                                        requestButton.textContent = 'Request Sent';
                                        requestButton.classList.add('request-sent');
                                    }
                                };

                                row.appendChild(dateCell);
                                row.appendChild(timeCell);
                                row.appendChild(counsellorCell);
                                requestCell.appendChild(requestButton);
                                row.appendChild(requestCell);
                                tbody.appendChild(row);
                            });

                            timeSlotsTable.appendChild(tbody);
                        } else {
                            // Display a message when there are no timeslots
                            timeSlotsTable.innerHTML = '<p>No available timeslots for this counselor.</p>';
                        }
                    })
                    .catch(error => {
                        
                        timeSlotsTable.style.display = 'block';
                    });
            }

            // Add an event listener to the counsellorSelect element
            const counsellorSelect = document.getElementById('counsellor');
            counsellorSelect.addEventListener('change', showTimeSlots);
        </script>
        <!-- <script src="script.js"> -->
        </script>  
        
</body>

</html>