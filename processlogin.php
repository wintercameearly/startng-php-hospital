<?php 

session_start();
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
    $_SESSION['error'] = $session_error;
     
   header("Location: login.php");
}else{
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);
    for ($counter =0; $counter <= $countAllUsers; $counter++){
        $currentUser = $allUsers[$counter];
        if($currentUser == $email. ".json"){
        //Check for password
            $userString = file_get_contents("db/users/".$currentUser);
            $userObject = json_decode($userString);
            $passwordFromDB = $userObject->password;

            $passwordFromUser = password_verify($password, $passwordFromDB);

            if($passwordFromDB == $passwordFromUser){

                //Timing
                //$currentTimeinSecs = time();
                    //$currentDate = date('Y-m-d', $currentTimeinSecs); 
                    //$currentTime=date("h:i a"); 

                    
                    //Create a  timing object
                    $timingObject =[
                        //'id' =>$newTimeId,
                        'time'=>$currentTime,
                        'date'=>$currentDate
                    ];

                //Login values
                $_SESSION['loggedIn']=$userObject->id;
                $_SESSION['email']=$userObject->email;
                $_SESSION['fullname']=$userObject->first_name . " " . $userObject->last_name;
                $_SESSION['role']=$userObject->designation;
                $_SESSION['department']=$userObject->department;
                $_SESSION['registrationdate']=$userObject->registrationdate;
                //Login based on designation/Access Level
                if($_SESSION['role']=='Medical Team(MT)') {
                    //
                    //if(empty($logString)){
                    file_put_contents("db/logs/".$email. ".json",json_encode($timingObject));
                    //}else{
                    //$fp = fopen("db/logs/".$email. ".json",'a');
                    //fwrite($fp, $timingObject);
                    //fclose($fp);
                    //}
                    header("Location: med_team.php");
                }elseif($_SESSION['role']=='Patients'){
                    //

                    file_put_contents("db/logs/".$email. ".json", json_encode($timingObject));
                    header("Location: patients.php");   
                }
                die();
            }
            
        }    
    }
    $_SESSION['error'] = 'Invalid Email or Password';
    header("Location: login.php");
    die();
}

?>