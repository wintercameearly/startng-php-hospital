<?php 
session_start();

$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;

$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION['email']= $email;

if($errorCount > 0){
    //redirect back and display error
    $_SESSION['error'] = 'You have '. $errorCount .' errors In your form submission';
   header("Location: login.php");
}else{
    echo "no errors";
}

?>