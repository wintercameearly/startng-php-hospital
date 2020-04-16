<?php 
include_once('lib/header.php');
require('functions/alert.php');
require('functions/users.php');

///check if token is set

if(!is_user_loggedIn() && !is_token_set()){
    $_SESSION['error']="You are not authorized to view that page ";
    header("Location: login.php");
}
?> 

<h3>Reset Password</h3>

    <form action="processreset.php" method="post">
        <?php message(); error(); ?>
        <?php  if(!is_user_loggedIn()){ ?>
        <input 
            <?php 
                if(isset($_SESSION['token'])){
                    echo "value='" .$_SESSION['token'] . "'";
                }else{
                    echo "value='" .$_GET['token'] . "'";
                }
            ?>
        type="hidden" name='token' value= "<?php echo $_GET['token'] ?>">
            <?php } ?>
        <p>
            <label for="email">Email</label>
            <input 
            <?php 
                if(isset($_SESSION['email'])){
                    echo "value= " .$_SESSION['email'];
                }
            ?>
            type="email" name="email" placeholder= "Email" >
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