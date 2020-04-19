<?php 
session_start();
$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;

$_SESSION['email']= $email;

if($errorCount > 0){
    //redirect back and display error
    $session_error = "You have " . $errorCount ." error";
    if($errorCount > 1){
        $session_error .= "s";

    };

    $session_error .= " in your form submission";
    $_SESSION['error'] = $session_error;
   header("Location: forgot.php");
}else{
    $allUsers = scandir("db/users/");

    
    $countAllUsers = count($allUsers);

    for ($counter =0; $counter <= $countAllUsers; $counter++){
        $currentUser = $allUsers[$counter];
        
        if($currentUser == $email. ".json"){
            //sending an email via mail function
            $token = ""; 

            $alphabets = ['a','b','c','d','e','f','g','h','i','j','k','l','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O'];

            for($i = 0 ; $i < 30 ; $i++){

            $index = mt_rand(0,count($alphabets)-1);
            $token .= $alphabets[$index];
            }

            
            $subject = "Password Reset Link";
            $message = "A password request reset has been initiated from your account, if you did not initiate this request , please ignore this message, otherwise visit : localhost/snh/reset.php?token=".$token;
            $headers = "From: nifemibams@hng.com" . "\r\n" .
            "CC: nobody@gmail.com";


            file_put_contents("db/tokens/".$email. ".json", json_encode(['token'=>$token]));
            $try = mail($email,$subject,$message,$headers);

            if($try){
                //Display a Success message
                $_SESSION['message'] = "Password Reset has been sent to: " .$email;
                header("Location: login.php");
            }else{
                //display an error message 
                $_SESSION['error'] = "Something went wrong , we couldnt send the reset to:  " .$email;
                header("Location: forgot.php");
            }

            die();
        }
    }
    $_SESSION["error"] = "Email not Registered with Us Error ".$email;
    header("Location: register.php"); 

}

?>