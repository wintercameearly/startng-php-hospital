<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
require_once('functions/users.php');
?> 
    <p>
        <?php print_alert(); ?>
    </p>
    
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Welcome to SNG: Hospital for the ignorant.</h1>
        <p class="lead">This is a specialist hospital</p>
        <p class="lead">Come as you are, its completely free</p>
        <p>
           <?php  if(!is_user_loggedIn()){?>
            <a class="btn btn-bg btn-outline-secondary" href= "login.php">Login</a>
            <a class="btn btn-bg btn-outline-primary" href="register.php" >Register</a>
           <?php } ?>
        </p>
    </div>
    
<?php 
include_once('lib/footer.php');
?>