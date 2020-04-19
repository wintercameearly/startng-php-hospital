<?php 
function is_user_loggedIn(){
    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
        return true;
    }
    return false;
}

function is_token_set(){
    if(isset($_GET['token'])|| isset($_SESSION['token'])){
        return true;
    }
    return false;
}


?>