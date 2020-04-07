<?php  include_once('lib/header.php');

if(!isset($_SESSION['loggedIn'])){
    header("Location: login.php");
}
?>
<h3>Dashboard</h3>
Welcome, <?php echo $_SESSION['fullname'] ?>, You are logged in as (<?php echo $_SESSION['role'] ?>), Your user ID is <?php echo $_SESSION['loggedIn'] ?>


<?php include_once('lib/footer.php'); ?>