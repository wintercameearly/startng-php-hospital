<?php 
include_once('lib/header.php');
require_once('functions/alert.php');
require_once('functions/users.php');

///check if token is set

//if(!$_SESSION['loggedIn'] &&  !isset($_GET['token']) && !isset($_SESSION['token']) ){
if(!is_user_loggedIn() && !is_token_set()){
    $_SESSION['error']="You are not authorized to view that page ";
    header("Location: login.php");
}
?> 


    <div class="container ">
    <h3>Reset Password</h3>
        <div class="row col-6">
            <form action="processreset.php" method="post">
                <?php print_alert(); ?>
                <?php  if(!is_user_loggedIn()){ ?>
                <?php  //if(!$_SESSION['loggedIn']){?>
                <input 
                    <?php 
                        if(is_token_set_in_session()){
                            echo "value='" .$_SESSION['token'] . "'";
                        }else{
                            echo "value='" .$_GET['token'] . "'";
                        }
                    ?>
                class="form-control" type="hidden" name='token' value= "<?php echo $_GET['token'] ?>">
                    <?php } ?>
                <p>
                    <label for="email">Email</label>
                    <input 
                    <?php 
                        if(isset($_SESSION['email'])){
                            echo "value= " .$_SESSION['email'];
                        }
                    ?>
                    class="form-control" type="email" name="email" placeholder= "Email" >
                </p>
                <p>
                    <label >New Password</label>
                    <input class="form-control" type="password" name="password" placeholder= "Password" >
                </p>
                <p>
                    <button class="btn btn-danger" type ="submit">Reset Password</button>
                </p>
            </form>
        </div>
    </div>
<?php include_once('lib/footer.php'); ?>