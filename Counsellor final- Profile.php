<?php
session_start();

include("connection.php");

if(!isset($_SESSION['email'])){
 header("Location: login.php");
  exit();
}

  $userEmail=$_SESSION['email'];


  $query="SELECT * FROM counsellor WHERE Email='$userEmail'";
  $result= mysqli_query($conn, $query);
  
  if (mysqli_num_rows($result) == 1) {
      $userDetails = mysqli_fetch_assoc($result);
      $fullName = $userDetails['First_name'] . ' ' . $userDetails['Last_name'];
  } else {
      
      echo "User details not found.";
  }

  ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
    body{
        margin: 0;
        padding: 0;
        padding-top: 0.5in;
        padding-bottom: 0.5in;
        padding-left: 1in;
        padding-right: 1in;
        font-family: 'Poppins', sans-serif;
        background-color: lightpink;
        align-items: center;
        justify-content: center;
    }

    *{
        box-sizing: border-box;
    }

    .container{
        display: flex;
        width: 100%;
        height: 70%;
        padding: 15px 15px;
        margin-left: 0.5in;
        margin-right: 0.5in;
    }

    .box{
        flex: 30%;
        display: table;
        align-items: center;
        text-align: center;
        font-size: 20px;
        background-color: rgb(112, 201, 112);
        color: black;
        padding: 30px 30px;
        border-radius: 20px;
    }

    .box img{
        border-radius: 50%;
        border: 2px solid #fff;
        height: 250px;
        width: 250px;
    }

    .box ul{
        margin-top: 30px;
        font-size: 30px;
        text-align: center;
    }
    .box ul li{
        list-style: none;
        margin-top: 50px;
        font-weight: 100;
    }

    .box ul li i{
        cursor: pointer;
        margin: 10px;
        font-size: 40px;
    }

    .box ul li i:hover{
        opacity: 0.6;
    }

    .About{
        margin-left: 20px;
        flex: 50%;
        display: table;
        padding: 30px 30px;
        font-size: 20px;
        background-color: #fff;
        border-radius: 20px;
    }

    .About h1{
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 50px;
        font-weight: 500;
    }

    .About ul li{
        list-style: none;
    }

    .About ul{
        margin-top: 20px;
    }

    /* Add styles for the "Edit Profile" button */
    .edit-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }

    .edit-button button {
        padding: 20px 30px;
        background-color: blue;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Add styles for the pop-up form */
    .edit-form {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 60px;
        background-color: rgb(169, 230, 227);
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        z-index: 999;
        width: 95%;
        max-width: 500px;
    }

    .edit-form label,
    .edit-form input,
    .edit-form textarea,
    .edit-form button {
        display: block;
        margin-bottom: 10px;
        width: 100%;
    }

    .edit-form textarea {
        resize: vertical;
    }

    /* Add styles for the Save and Cancel buttons in the pop-up form */
    .edit-form button.save-button {
        background-color: yellow;
    }

    .edit-form button.cancel-button {
        background-color: yellow;
    }
</style>
<body>
    <div class="container">
        <div class="box">
            <ul>
                <h1>My Profile</h1>
            </ul>
            <img src="assets/rdj.jpeg" alt="">
            <ul>
                <li><?= $fullName?></li>
                <li>Counselllor ID -<?= $userDetails['Counsellor_ID'] ?></li>
                <li></li>
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
        <form action="counsellor_profile_update.php" method="post">
            <label for="name">First Name:</label>
            <input type="text" id="name" name="firstname" >

            <label for="name">Last Name:</label>
            <input type="text" id="name" name="lastname" >

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" >

            <!-- <label for="email">Email:</label> -->
            <!-- <input type="email" id="email" name="email"> -->

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" >

            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" rows="4"></textarea>

            <!-- Add the Save and Cancel buttons to the form -->
            <button type="submit" name="submit" >Save</button>
            <button type="button" class="cancel-button" onclick="closeEditForm()">Cancel</button>
        </form>
        <div>
            <!-- Add the profile photo input to change the profile picture -->
            <label for="profilePhoto">Profile Photo:</label>
            <input type="file" id="profilePhoto" accept="image/*" onchange="changeProfilePhoto()">
        </div>
    </div>

    <script>
       function openEditForm() {
  const editForm = document.getElementById("editForm");
  editForm.style.display = "block";

  // Fill the form fields with current profile data
  document.getElementById("name").value ="First Name";
  document.getElementById("name").value ="Last Name";
  document.getElementById("phone").value = "Contact";
  document.getElementById("email").value = "Email";
  document.getElementById("address").value = "Address";
  document.getElementById("bio").value =" Your Bio";
}

function closeEditForm() {
  const editForm = document.getElementById("editForm");
  editForm.style.display = "none";
}

function saveProfileData() {
  const name = document.getElementById("name").value;
  const phone = document.getElementById("phone").value;
  const email = document.getElementById("email").value;
  const address = document.getElementById("address").value;
  const bio = document.getElementById("bio").value;

  // Update the profile data here (e.g., send data to the server)

  // Close the form
  closeEditForm();
}

function changeProfilePhoto() {
  // Implement the logic to change the profile photo here
  alert("You can implement the logic to change the profile photo here.");
}
        
    </script>
</body>
</html>

       