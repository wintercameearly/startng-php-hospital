<?php include_once('lib/header.php'); session_start(); ?> 
Login Form here 

<p>
    <?php 
        if(isset($_SESSION['message'])&& !empty($_SESSION['message'])){
            echo "<span style='color:green'>".$_SESSION['message']. "<span/>";
            session_destroy();
        }
    ?>
</p>
<h3>Login</h3>
<form action="processlogin.php" method="post">
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
            <label for="password">Password</label>
            <input type="password" name="password" placeholder= "Password" >
        </p>
        <p>
        <button type="submit">Login</button>
        </p>
    </form>





<?php include_once('lib/footer.php'); ?>