<?php  
session_start();

$errorCount = 0;


if(!$_SESSION['loggedIn']){
    $token = $_POST['token'] != "" ? $_POST['token'] : $errorCount++;
    $_SESSION['token'] =$token;
}


$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION['token']= $token;
$_SESSION['email']= $email;

if($errorCount > 0){
    $session_error = "You have " .$errorCount . "error";

    if($errorCount > 0){
        $session_error .= "s";
    }
    $session_error .= "in your form submission";
    $_SESSION['error'] = $session_error;
    header("Location: reset.php");
}else{
    $allUserTokens = scandir("db/tokens/");

    $countAllTokens = count($allUserTokens);

    for ($counter = 0; $counter < $countAllTokens; $counter++){
        $currentTokenFile = $allUserTokens[$counter];
        if($currentTokenFile == $email. ".json"){

            //Check if the current token corresponds to the retrieved token
            $tokenContent = file_get_contents("db/tokens/".$currentTokenFile);
            $tokenObject = json_decode($tokenContent);
            $tokenFromDB = $tokenObject->token;

            if($_SESSION['loggedIn']){
                $checkToken = true;
            }else{
                $checkToken = $tokenFromDB == $token;
            }



            if($checkToken){
            //if($tokenFromDB == $token){
                //If the token corresponds, find the user file
                $allUsers = scandir("db/users");
                $countAllUsers = count($allUsers);
                for ($counter =0; $counter <= $countAllUsers; $counter++){
                    $currentUser = $allUsers[$counter];
                    if($currentUser == $email. ".json"){
                        //Open Previous user file and change password
                        $userString = file_get_contents("db/users/".$currentUser);
                        $userObject = json_decode($userString);

                        $userObject->password = password_hash($password, PASSWORD_DEFAULT);
                        //Delete Previous user file 
                        unlink("db/users/".$currentUser);
                        
                        file_put_contents("db/users/".$email. ".json", json_encode($userObject));
                        $_SESSION["message"] = "Password Reset Successful, You can now Login";
                            /** INFORM USER OF PASSWORD RESET */
                            $subject = "Password Reset Successful";
                            $message = "A password reset has just been carried out on your SNH account. If you didnt initiate the password change , please visit snh.org to RESET ";
                            $headers = "From: nifemibams@hng.com" . "\r\n" .
                            "CC: nobody@gmail.com";
                            $try = mail($email,$subject,$message,$headers);
                            /**USER INFORM END */
                        header("Location: login.php"); 
                        die();
                    }    
                }
            }

            die();
        }
    }

    $_SESSION["error"]= "Password Reset Failed, token/email invalid or expired" .$first_name;
    header("Location:login.php");

}


?>