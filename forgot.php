<?php 
include_once('lib/header.php');
require_once('functions/alert.php')
?> 
<div class="container">
    <div class='row'><h3>Forgot form here</h3></div>
    <div class='row'><p>Provide the email you registered with</p></div>
    <div class='row'>
    <form action="processForgot.php" method="post">
    <p>
    <?php print_alert(); ?>
    </p>
    <p>
        <label for="email">Email</label>
        <input
                <?php 
                    if(isset($_SESSION['email'])){
                        echo "value=" .$_SESSION['email'];
                    }
                ?>
            class="form-control" type="email" name="email" placeholder= "Email" >
        </p>
        <p>
            <button class="btn btn btn-success"  type ="submit">Send Reset Code</button>
        </p>
    </form>
    </div>
</div>


<?php include_once('lib/footer.php'); ?>