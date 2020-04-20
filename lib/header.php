<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<?php 
require_once('functions/alert.php');
require_once('functions/redirect.php');
require_once('functions/token.php');
require_once('functions/users.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to SNG</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js"></script>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal"> <a href="index.php">Start.NG Hospital</a> </h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <?php if(!is_user_loggedIn()){ ?>
    <a class="p-2 text-dark" href="login.php">Login</a>
    <a class="btn btn-outline-primary" href="register.php">Register</a>
    <?php }elseif(is_user_loggedIn() && $_SESSION['role'] == 'Medical Team(MT)'){ ?>
    <a class="p-2 text-dark" href="dashboard.php">Dashboard</a>
    <a class="p-2 text-dark" href="med_team.php">Medical Team Page</a>
    <a class="p-2 text-dark" href="reset.php">Reset</a>
    <a class="p-2 text-dark" href="logout.php">Logout</a>
    <?php }elseif(is_user_loggedIn() && $_SESSION['role'] == 'Patients'){ ?>
    <a class="p-2 text-dark" href="dashboard.php">Dashboard</a>
    <a class="p-2 text-dark" href="patients.php">Patients</a>
    <a class="p-2 text-dark" href="reset.php">Reset</a>
    <a class="p-2 text-dark" href="logout.php">Logout</a>
    <?php } ?>
    
  </nav>
  
</div>