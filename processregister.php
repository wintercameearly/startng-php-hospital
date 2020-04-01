<?php 

session_start();

$errorCount = 0;

//Verification and Validation
$first_name = $_POST['first_name'] != "" ? $_POST['first_name'] : $errorCount++;
$last_name = $_POST['last_name'] != "" ? $_POST['last_name'] : $errorCount++;
$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;

$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;
$gender = $_POST['gender'] != "" ? $_POST['gender'] : $errorCount++;
$designation = $_POST['designation'] != "" ? $_POST['designation'] : $errorCount++;
$department = $_POST['department'] != "" ? $_POST['department'] : $errorCount++;


$_SESSION['first_name']= $first_name;
$_SESSION['last_name']= $last_name;
$_SESSION['email']= $email;
$_SESSION['gender']= $gender;
$_SESSION['designation']= $designation;
$_SESSION['department']= $department;

if($errorCount > 0){
    //redirect back and display error
    $_SESSION['error'] = 'You have '. $errorCount .' errors In your form submission';
   header("Location: register.php");
}else{
    //continue
    echo "Success";
}



//saving the data into the db (folder)



//


?>