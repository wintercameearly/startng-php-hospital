<?php 
include_once('lib/header.php');
require('functions/alert.php')
?> 

<h3>Forgot form here</h3>
<p>Provide the email you registered with</p>
    <form action="processForgot.php" method="post">
<p>
 <?php message(); error(); ?>
</p>
        <p>
            <label for="email">Email</label>
            <input
                <?php 
                    if(isset($_SESSION['email'])){
                        echo "value=" .$_SESSION['email'];
                    }
                ?>
            type="email" name="email" placeholder= "Email" >
        </p>
        <p>
            <button type ="submit">Send Reset Code</button>
        </p>
    </form>

<?php include_once('lib/footer.php'); ?>