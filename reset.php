<?php 
include_once('lib/header.php');


///check if token is set

if(!$_SESSION['loggedIn'] && !isset($_GET['token']) && !isset($_SESSION['token'])){
    $_SESSION['error']="You are not authorized to view that page ";
    header("Location: login.php");
}
?> 

<h3>Reset Password</h3>

    <form action="processreset.php" method="post">
        <p>
        <?php 
            if(isset($_SESSION['error'])&& !empty($_SESSION['error'])){
                echo "<span style='color:red'>".$_SESSION['error']. "<span/>";
                session_destroy();
            }
        ?>
        </p>
        <?php  if(!$_SESSION['loggedIn']){ ?>
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