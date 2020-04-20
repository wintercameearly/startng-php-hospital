<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('functions/alert.php');
require_once('functions/redirect.php');
require_once('functions/token.php');
require_once('functions/users.php');


$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;

$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION['email']= $email;

if($errorCount > 0){
    //redirect back and display error

    $session_error = "You have " . $errorCount ." error";
    if($errorCount > 1){
        $session_error .= "s";
    };

    $session_error .= " in your form submission";
    set_alert("error",$session_error);
    redirect_to("login.php");
}else{
        $currentUser = find_user($email);
        if($currentUser){
        //Check for password
            //Accept email from user object
            $currentUserEmail = $currentUser->email;
            $userString = file_get_contents("db/users/".$currentUserEmail .".json");
            $userObject = json_decode($userString);
            $passwordFromDB = $userObject->password;
            $passwordFromUser = password_verify($password, $passwordFromDB);

            if($passwordFromDB == $passwordFromUser){
                //Timing
                check_login_time();
                //Login values
                $_SESSION['loggedIn']=$userObject->id;
                $_SESSION['email']=$userObject->email;
                $_SESSION['fullname']=$userObject->first_name . " " . $userObject->last_name;
                $_SESSION['role']=$userObject->designation;
                $_SESSION['department']=$userObject->department;
                $_SESSION['registrationdate']=$userObject->registrationdate;
                //Login based on designation/Access Level
                if($_SESSION['role']=='Medical Team(MT)') {
                    save_log($timingObject);
                    redirect_to("med_team.php");
                }elseif($_SESSION['role']=='Patients'){
                    save_log($timingObject);
                    redirect_to("patients.php");  
                }
                die();
            }
            
        }    
    
    $_SESSION['error'] = 'Invalid Email or Password';
    header("Location: login.php");
    die();
}

?>