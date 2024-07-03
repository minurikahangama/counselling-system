<?php
session_start();

include("1connection.php");

if(!isset($_SESSION['email'])){
  header("Location: login.php");
  exit();
}

  $userEmail=$_SESSION['email'];


  $query="SELECT * FROM user WHERE Email='$userEmail'";
  $result= mysqli_query($conn, $query);
  
  if (mysqli_num_rows($result) == 1) {
      $userDetails = mysqli_fetch_assoc($result);
      $fullName = $userDetails['First_Name'] . ' ' . $userDetails['Last_Name'];
  } else {
      
      echo "User details not found.";
  }

  ?>

<?php

include("1connection.php");

// Fetch notifications for the logged-in user
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

// Update notification status to 'read'
$updateReadQuery = "UPDATE appointment SET Notification_Status = 'read' WHERE User_ID = '$user_id' AND Notification_Status = 'unread'";
mysqli_query($conn, $updateReadQuery);
?>





<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                          

                                         <!-- Nav Item - Alerts -->
                                         <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
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
                            <?php endif;?>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['email']; ?></span>
                                    <img class="img-profile rounded-circle"
                                        src="img/undraw_profile.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i cl ass="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
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

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <div class="container">
                        <link rel="stylesheet" href="profile.css">
                            <div class="box">
                            <ul>
                                <h1>My Profile</h1>
                            </ul>
                                   

                            <?php if (isset($_SESSION['uploaded_photo'])): ?>
                                <img class="img-profile rounded-circle" src="PhotoUpload/<?php echo $_SESSION['uploaded_photo']; ?>" alt="Profile Picture">
                            <?php else: ?>
                                <p>No profile picture uploaded.</p>
                            <?php endif; ?>
                            

                            
                            <ul>
                                <li><?= $fullName?></li>
                               
                            
                           <form action="upload.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="profile_picture" accept="image/*" required>
                                <input type="submit" value="Upload Picture">
                            </form> 
                                
                                <li>
                                    <i style="font-size:24px" class="fa fa-facebook"></i>
                                    <i style="font-size:24px" class="fa fa-google"></i>
                                    <i style="font-size:24px" class="fa fa-twitter"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="About">            
                            <ul>
                                <h3>Full Name</h3>
                                <li><?= $fullName?></li>
                            </ul>
                            <ul>
                                <h3>Phone</h3>
                                <li><?= $userDetails['Contact'] ?></li>
                            </ul>
                            <ul>
                                <h3>Email</h3>
                                <li><?= $userDetails['Email'] ?></li>
                            </ul>
                            <ul>
                                <h4>Address</h4>
                                <li><?= $userDetails['Addres'] ?></li>
                            </ul>
                            <ul>
                                <h3>Bio</h3>
                                <p><?= $userDetails['Bio'] ?></p>
                            </ul>
                        </div>
                    </div>
                
                    <!-- Add the "Edit Profile" button and the pop-up form -->
                    <div class="edit-button">
                        <button onclick="openEditForm()">Edit Profile</button>
                    </div>
                    <div class="edit-form" id="editForm">
                        <form action ="update_profile.php" method="post">
                            <label for="name">First Name:</label>
                            <input type="text" id="name" name="firstname" >

                            <label for="name">Last Name:</label>
                            <input type="text" id="name" name="lastname" >
                
                
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" name="phone">
                
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" >
                
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="addres" >
                
                            <label for="bio">Bio:</label>
                            <textarea id="bio" name="bio" rows="4"></textarea>
                
                            <!-- Add the Save and Cancel buttons to the form -->
                            <button type="submit" name="submit">Save</button>
                            <button type="button" class="cancel-button" onclick="closeEditForm()">Cancel</button>
                        </form>
                        <div>
                            <!-- Add the profile photo input to change the profile picture -->
                            <label for="profilePhoto">Profile Photo:</label>
                            <input type="file" id="profilePhoto" accept="image/*" onchange="changeProfilePhoto()">
                        </div>
                    </div>

                   
                      <script src="profile.js"></script>

                </div>
                <!-- /.container-fluid -->

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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>