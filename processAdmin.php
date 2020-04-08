<?php 

session_start();
$errorCount = 0;

$username = $_POST['username'];

$password = $_POST['password'];
$authAdmin = $username .".json";

$allAdmin = scandir("db/superadmin/");

$countAdmin = count($allAdmin);

for ($counter =0; $counter <= $countAdmin; $counter++){
    $currentAdmin = $allAdmin[$counter];

    if( $currentAdmin == $authAdmin){
        $adminString = file_get_contents("db/superadmin/".$currentAdmin);
        $adminObject = json_decode($adminString);
        
            $passwordFromDB = $userObject->password;
            $passwordFromUser = password_verify($password, $passwordFromDB);
            if($passwordFromDB == $passwordFromUser){
                //Create an active session
                $isActive = 1;
                $_SESSION['isActive'] = $isActive;
                //Log admin access time
                $currentTimeinSecs = time();
                    $currentDate = date('Y-m-d', $currentTimeinSecs); 
                    $currentTime=date("h:i a"); 
                    $timingObject =[
                        'time'=>$currentTime,
                        'date'=>$currentDate
                    ];
                file_put_contents("db/logs/".$username. ".json",json_encode($timingObject));
                //Redirect to admin dashboard
                header("Location: admin_dashboard.php");
                die();
            }
}
}

?>