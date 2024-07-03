<?php
include("1connection.php");

session_start();




if (!isset($_SESSION['email'])) {
    
    header("Location: login.php");
    exit();
  }
  
  $email = $_SESSION['email'];
  $query = "SELECT * FROM user WHERE email='$email'";
  $result = mysqli_query($conn, $query);
  
  if (mysqli_num_rows($result) == 1) {
   $userDetails = mysqli_fetch_assoc($result);
  } else {
    echo "User details not found.";
    exit();
  }
  
  
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['submit'])) {

 $question1Answer = $_POST['q1'];
 $question2Answer = $_POST['q2'];
$question3Answer = $_POST['q3']; 
$question4Answer = $_POST['q4'];
$question5Answer = $_POST['q5']; 
$question6Answer = $_POST['q6'];
$question7Answer = $_POST['q7'];
$question8Answer = $_POST['q8'];
$question9Answer = $_POST['q9']; 
$question10Answer = $_POST['q10'];
$question11Answer = $_POST['q11']; 
$question12Answer = $_POST['q12'];
$question13Answer = $_POST['q13']; 
$question14Answer = $_POST['q14'];
$question15Answer = $_POST['q15']; 
$question16Answer = $_POST['q16'];
$question17Answer = $_POST['q17']; 
$question18Answer = $_POST['q18'];
$question19Answer = $_POST['q19']; 
$question20Answer = $_POST['q20'];
$question21Answer = $_POST['q21'];

      
      $answers = array($question1Answer,$question2Answer,$question3Answer,$question4Answer,$question5Answer,$question6Answer,$question7Answer,$question8Answer,$question9Answer,$question10Answer,$question11Answer,$question12Answer,$question13Answer,$question14Answer,$question15Answer,$question16Answer,$question17Answer,$question18Answer,$question19Answer,$question20Answer,$question21Answer);
  
      $stmt = mysqli_prepare($conn, "UPDATE user SET Score = ? WHERE Email = ?");
      mysqli_stmt_bind_param($stmt, "is", $totalMarks, $email);

      $totalMarks = array_sum($answers);


      if ($totalMarks >= 1 && $totalMarks <= 10) {
        $mentalCategory = "Normal";
      } elseif ($totalMarks >= 11 && $totalMarks <= 16) {
        $mentalCategory = "Mild mood disturbance";
      } elseif ($totalMarks >= 17 && $totalMarks <= 20) {
        $mentalCategory = "Borderline clinical depression";
      } elseif ($totalMarks >= 21 && $totalMarks <= 30) {
        $mentalCategory = "Moderate depression";
      } elseif ($totalMarks >= 31 && $totalMarks <= 40) {
        $mentalCategory = "Severe depression";
      } else {
        $mentalCategory = "Extreme depression";
      }
      
      $email = $userDetails['Email']; 
      $userMarks = $totalMarks;
      $userMentalCategory = $mentalCategory;


   
$sql = "UPDATE user SET Score = $totalMarks, Mental_Status = '$mentalCategory' WHERE Email = '$email'";
if (mysqli_query($conn, $sql)) {
  echo "Total Marks and Mental Category updated successfully.";
} else {
  echo "Error updating total marks and mental category: " . mysqli_error($conn);
}
mysqli_stmt_close($stmt);

}
}
?>


 















      