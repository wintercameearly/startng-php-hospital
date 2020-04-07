<?php 
include_once('lib/header.php');
?> 

<h3>Forgot form here</h3>
<p>Provide the email you registered with</p>
    <form action="processForgot.php" method="post">
        <p>
        <?php 
            if(isset($_SESSION['error'])&& !empty($_SESSION['error'])){
                echo $_SESSION['error'];
                session_destroy();
            }
        ?>
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