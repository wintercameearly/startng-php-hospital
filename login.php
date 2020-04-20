<?php include_once('lib/header.php'); 
    require_once('functions/alert.php');
    require_once('functions/users.php');

   if(is_user_loggedIn()){
        if($_SESSION['role']=='Medical Team(MT)'){
            header("Location: med_team.php");
        }else{
            header("Location:patient.php");}
    }
?> 

<p>
 
</p>
<div class="container">
    <div>
    
    <div class = "row col-6"><strong> Login</strong></div>
    <div class="row col-6"><?php print_alert(); ?></div>
    </div>
    <div class ="row col-6">
        <form action="processlogin.php" method="post">
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
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" placeholder= "Password" >
            </p>
            <p>
                <button class="btn btn-sm btn-primary "type="submit">Login</button>
            </p>
            <p>
                <a href="forgot.php">Forgot Password?</a> |
                <a href="register.php">Don't have an account ? Register !</a>
            </p>

        </form>
    </div>
</div>
<?php include_once('lib/footer.php'); ?>