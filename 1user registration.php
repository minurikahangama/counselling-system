<?php
session_start();
include ("1connection.php");

if(isset($_POST['submit'])){


        $firstName=$_POST['FirstName'];
        $lastName=$_POST['LastName'];
        $email=$_POST['email'];
        $dob=$_POST['dob'];
        $addres=$_POST['Addres'];
        $phone=$_POST['phone'];
        $nic=$_POST['NIC'];
        $occupation=$_POST['Occupation'];
        $gender=$_POST['Gender'];
        $maritualStatus=$_POST['MaritualStatus'];
        $childrenStatus=$_POST['children'];
        $previousCounselling=$_POST['counselling'];
        $bio=$_POST['Bio'];
        $pregnancy=$_POST['pregnancy'];

      

        //$query="INSERT INTO user(First_Name,Last_Name,Gender,Email,Addres,Contact,NIC,Occupation,Maritual_Status,Children_Status,Pregnancy,Previous_Counselling,Bio,DOB,Photo)
              //  VALUES('$firstName','$lastName','$gender','$email','$addres','$phone','$nic','$occupation','$maritualStatus','$childrenStatus','$pregnancy','$previousCounselling','$bio','$dob',$photo')";

              $query = "INSERT INTO user (First_Name, Last_Name, Gender, Email, Addres, Contact, NIC, Occupation, Maritual_Status, Children_Status, Pregnancy, Previous_Counselling, Bio, DOB)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    
    $stmt = mysqli_prepare($conn, $query);
    
    
    mysqli_stmt_bind_param($stmt, "ssssssssssssss", $firstName, $lastName, $gender, $email, $addres, $phone, $nic, $occupation, $maritualStatus, $childrenStatus, $pregnancy, $previousCounselling, $bio, $dob);
    
   
    if (mysqli_stmt_execute($stmt)) 
    {
        $email=$_SESSION['email'];
        $query = "SELECT User_ID FROM user WHERE Email='$email'";
        $result = mysqli_query($conn, $query);

        if ($result) {
           
            $row = mysqli_fetch_assoc($result);
            $userID = $row['User_ID'];
            $_SESSION['User_ID'] = $userID;
            echo 'ok';
        }

        echo "New record has been added successfully !";
        header("Location: index.php");
        exit();

    } else {
        
        echo "Error: " . mysqli_error($conn);
    }
    

    mysqli_stmt_close($stmt);


    
    
    mysqli_close($conn);
    
    
   }
   ?>  
    


