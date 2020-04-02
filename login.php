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


<?php include_once('lib/footer.php'); ?>