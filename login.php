<?php
session_start();
include("1connection.php");


if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);


    $query = "SELECT * FROM sign_up WHERE Email='$email' AND Pass='$pass'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $userDetails = mysqli_fetch_assoc($result);

        echo "Password matches, login successful";

        $_SESSION['email'] = $email;

        if (is_admin($email)) {
            echo "login successfull admin";
            $admin_id = get_Admin_ID($email); 
            $_SESSION['Admin_ID'] = $admin_id; 
            header("Location:Admin_Navigation.html");
            exit();
        } elseif (is_counsellor($email)) {
            echo "login successfull counsellor";
            $counsellor_id = get_Counsellor_ID($email); 
            $_SESSION['Counsellor_ID'] = $counsellor_id; 
            header("Location: Counsellor - navigation.html");
            exit();
        } elseif (is_user($email)) {
            echo "login successfull user";
            $user_id = get_User_ID($email); 
            $_SESSION['User_ID'] = $user_id; 
            header("Location:index.php");
            exit();
        } else {
            header("Location:1proceed.html");
            exit();
        
        }
    } else {
        echo "Invalid username or password.";
    }
    }
        




function is_admin($email) {
    global $conn;
    $query = "SELECT * FROM admin_table WHERE Email='$email'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) == 1;
   
}

function is_counsellor($email) {
    global $conn;
    $query = "SELECT * FROM counsellor WHERE Email='$email'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) == 1;
    
}


function is_user($email) {
    global $conn;
    $query = "SELECT * FROM user WHERE Email='$email'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) == 1;
}

function get_Counsellor_ID($email) {
    global $conn;
    $query = "SELECT Counsellor_ID FROM counsellor WHERE Email='$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Query execution failed, handle the error
        echo "Error: " . mysqli_error($conn);
        return null;
    }

    $row = mysqli_fetch_assoc($result);
    return $row ? $row['Counsellor_ID'] : null; 
}

function get_Admin_ID($email) {
    global $conn;
    $query = "SELECT Admin_ID FROM admin_table WHERE Email='$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Query execution failed, handle the error
        echo "Error: " . mysqli_error($conn);
        return null;
    }

    $row = mysqli_fetch_assoc($result);
    return $row ? $row['Admin_ID'] : null; 
}


function get_User_ID($email) {
    global $conn;
    $query = "SELECT User_ID FROM user WHERE Email='$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Query execution failed, handle the error
        echo "Error: " . mysqli_error($conn);
        return null;
    }

    $row = mysqli_fetch_assoc($result);
    return $row ? $row['User_ID'] : null; 
}


?>
