<?php 
//Check for session status and start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
//Require necessary functions
require_once('functions/alert.php');
require_once('functions/users.php');
require_once('functions/email.php');
require_once('functions/redirect.php');
require_once('functions/token.php');

$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;

$_SESSION['email']= $email;

if($errorCount > 0){
    //redirect back and display error
    $session_error = "You have " . $errorCount ." error ";
    if($errorCount > 1){
        $session_error .= "s";

    };

    $session_error .= " in your form submission";
   set_alert('error',$session_error);
   redirect_to("forgot.php");
}else{
    $allUsers = scandir("db/users/");

    $countAllUsers = count($allUsers);

    for ($counter =0; $counter <= $countAllUsers; $counter++){
        $currentUser = $allUsers[$counter];
        
        if($currentUser == $email. ".json"){
            //sending an email via mail function
            $token = generate_token();
            
            $subject = "Password Reset Link";
            $message = "A password request reset has been initiated from your account, if you did not initiate this request , please ignore this message, otherwise visit : localhost/snh/reset.php?token=".$token;

            file_put_contents("db/tokens/".$email. ".json", json_encode(['token'=>$token]));

            send_mail($subject,$message,$email);

            die();
        }
    }
    set_alert('error',"Email not registered with us ERR: " . $email);
   
    redirect_to("forgot.php");

}

?>