<?php 
include_once("lib/header.php");
if($_SESSION['role']!='Patients'){
    header("Location: login.php");
}
?>
<h3>Patients Page</h3>

<?php 


?>

<?php 
include_once("lib/footer.php")
?>