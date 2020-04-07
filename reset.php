<?php 
include_once('lib/header.php');

///check if token is set

if(!isset($_GET['token']))
?> 

<h3>Reset Password</h3>
<p>Reset password assosciated with your account : [email]</p>
    <form action="processreset.php" method="post">
        <p>
        <?php 
            if(isset($_SESSION['error'])&& !empty($_SESSION['error'])){
                echo $_SESSION['error'];
                session_destroy();
            }
        ?>
        </p>
        <input type="hidden" name='token' value= "<?php echo $_GET['token'] ?>">
        <p>
            <label for="email">Email</label>
            <input readonly value ='[email]'type="email" name="email" placeholder= "Email" >
        </p>
        <p>
            <label >New Password</label>
            <input type="password" name="password" placeholder= "Password" >
        </p>
        <p>
            <button type ="submit">Reset Password</button>
        </p>
    </form>

<?php include_once('lib/footer.php'); ?>