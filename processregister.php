<?php 

print_r($_POST);


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$designation = $_POST['designation'];
$department = $_POST['department'];

$errorArray = [];


//Verification and Validation

if($first_name == ""){
    $errorArray = "first name cannot be empty";
}

print_r($errorArray);
?>