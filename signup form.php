
<?php

session_start();
include("1connection.php");

$message='';

if(isset($_POST['submit'])){


$First_name=mysqli_real_escape_string($conn,$_POST['firstname']);
$Last_name=mysqli_real_escape_string($conn,$_POST['lastname']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$pass=mysqli_real_escape_string($conn,$_POST['password']);
$confirmPass=mysqli_real_escape_string($conn,$_POST['cpassword']);

$_SESSION['email']=$email;


//hash the password
//$hashedPassword=password_hash($plainPassword,PASSWORD_DEFAULT);
  
$select=mysqli_query($conn,"SELECT * FROM sign_up WHERE Email='$email'");



if(mysqli_num_rows($select) > 0){
   echo  $message ='user already exist';

}
 else if($pass!=$confirmPass){
   echo $message = 'confirm password not matched!';

  } 
 else{

  $query=mysqli_query($conn,"INSERT INTO sign_up(First_Name,Last_Name,Email,Pass,ConfirmPassword) 
  Values('$First_name','$Last_name','$email','$pass','$confirmPass')") ;


  
  if($query){
   echo $message = 'registration successfull!';
   header("Location:login.html");
   exit();

    
  }
  else{
     echo $message = 'registration unsuccessfull!';
    
  }
 }
}

?>
