<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('functions/users.php');
require_once('functions/alert.php');
require_once('functions/redirect.php');
require_once('functions/token.php');


$first_nameErr =0;
$last_nameErr = 0;
$emailErr = 0;
$passwordErr = 0;
$genderErr = 0;
$designationErr = 0;
$deptErr = 0;


$errorCount = 0;

//Verification and Validation


$first_name = $_POST['first_name'] != "" ? $_POST['first_name'] : $first_nameErr++;
$last_name = $_POST['last_name'] != "" ? $_POST['last_name'] : $last_nameErr++;
$email = $_POST['email'] != "" ? $_POST['email'] : $emailErr++;

$password = $_POST['password'] != "" ? $_POST['password'] : $passwordErr++;
$gender = $_POST['gender'] != "" ? $_POST['gender'] : $genderErr++;
$designation = $_POST['designation'] != "" ? $_POST['designation'] : $designationErr++;
$department = $_POST['department'] != "" ? $_POST['department'] : $deptErr++;

$errorCount = $first_nameErr + $last_nameErr + $emailErr + $passwordErr + $genderErr + $designationErr + $deptErr ;


$_SESSION['first_name']= $first_name;
$_SESSION['last_name']= $last_name;
$_SESSION['email']= $email;
$_SESSION['gender']= $gender;
$_SESSION['designation']= $designation;
$_SESSION['department']= $department;

$name_pattern = '/^[a-zA-Z]*$/';
$email_pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
preg_match($name_pattern, $first_name, $name_matches);
preg_match($email_pattern, $email, $email_matches);

if(!$name_matches[0]){
    $first_nameErr++;
    $session_error_fname = "First name has non-alphabets";
    $_SESSION['error'] = $session_error_fname;
    header("Location: register.php");
    die();
}elseif($last_nameErr>0){
    $session_error_lname = "Your last name has issues ";
    $_SESSION['error'] = $session_error_lname;
}elseif(!$email_matches[0]){
    $emailErr++;
    $session_error_email = "Must be a valid email format";
    $_SESSION['error']=$session_error_email;
}elseif($errorCount > 0){
    //redirect back and display error
    $session_error = "You have " . $errorCount ." error";
    if($errorCount > 1){
        $session_error .= "s";

    };

    $session_error .= " in your form submission";
    $_SESSION['error'] = $session_error;
    header("Location: register.php");
}else{
        //if there are no errors

    $currentTimeinSecs = time();
    $registrationdate = date('Y-m-d', $currentTimeinSecs); 
    

    $allUsers = scandir("db/users/"); // return @array (2 filled)
    $countAllUsers = count($allUsers);

    
    $newUserId = ($countAllUsers - 1);

    $userObject = [
    'id'=>$newUserId,
    'first_name'=>$first_name,
    'last_name'=>$last_name,
    'email'=>$email,
    'password'=> password_hash($password, PASSWORD_DEFAULT), //password hashing
    'gender'=>$gender,
    'designation'=>$designation,
    'department'=>$department,
    'registrationdate'=>$registrationdate
    ];


    //Check if user exists
    $userExists = find_user($email);

    if($userExists){
        set_alert("error","Registration failed , User already exists ");
        redirect_to("register.php");
        die();
    }
    
    //saving the data into the db (folder)
    save_user($userObject);

    set_alert("message","Registration Successful, you can now login ");
    redirect_to("login.php");

}
?>