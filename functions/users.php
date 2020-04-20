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
?>