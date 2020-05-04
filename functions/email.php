<?php 
require_once('alert.php');
require_once('redirect.php');

if(!isset($_SESSION['loggedIn'])){
    header("Location: login.php");
}



function send_mail(
    $subject = '',
    $message = '',
    $email = '',
    $type = ''
){
    $headers = "From: no-reply@snh.org". "\r\n" . 
    "CC: nifbam@snh.org";

    $try = mail($email,$subject,$message,$headers);

    if($try){
        //Check for type of mail
       set_alert('message',"Password reset has been sent to your email: " . $email);        
       redirect_to("login.php");     
    }else{
        set_alert('error',"Something went wrong, we could not send password reset to :" . $email);             
        redirect_to("forgot.php");}

    }


?>