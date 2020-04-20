<?php include_once('alert.php');

function is_user_loggedIn(){
    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
        return true;
    }
    return false;
}

function is_token_set(){

    return is_token_set_in_get() || is_token_set_in_session();
}

function is_token_set_in_session(){
    return isset($_SESSION['token']);
}

function is_token_set_in_get(){
    return isset($_GET['token']);
}

function find_user($email = ""){
    if(!$email){
        set_alert('error','User email not set');
    }
    $allUsers = scandir("db/users/"); // return @array (2 filled)
    $countAllUsers = count($allUsers);


    for ($counter =0; $counter <= $countAllUsers; $counter++){
        $currentUser = $allUsers[$counter];
        if($currentUser == $email. ".json"){
        //Check for password
            $userString = file_get_contents("db/users/".$currentUser);
            $userObject = json_decode($userString);
            
            return $userObject;
        }
    }

    return false;
}

function save_user($userObject){
    file_put_contents("db/users/". $userObject['email'] . ".json", json_encode($userObject));
}


function save_user_reset($userObject){
    file_put_contents("db/users/". $userObject->email . ".json", json_encode($userObject));
}

function save_log($timingObject){
    file_put_contents("db/logs/".$email. ".json",json_encode($timingObject));
}

function check_login_time(){
    $currentTimeinSecs = time();
    $currentDate = date('Y-m-d', $currentTimeinSecs); 
    $currentTime=date("h:i a"); 
    //Create a  timing object
    $timingObject =[
        //'id' =>$newTimeId,
        'time'=>$currentTime,
        'date'=>$currentDate
        ];
}

function find_log(){
    //To check for login date and time 
    $allLogs = scandir("db/logs/");
    $countLogs = count($allLogs);
    for ($counter =0; $counter < $countLogs; $counter++){
    $currentUser = $allLogs[$counter];
    $email = $_SESSION['email'];
    if($currentUser == $email. ".json"){
        $detailString = file_get_contents("db/logs/".$currentUser);
        $userObject = json_decode($detailString);
        $lastlogindate = $userObject->date;
        $lastlogintime = $userObject->time;
    }
    }
}

 
?>