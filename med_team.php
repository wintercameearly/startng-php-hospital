<?php 
include_once("lib/header.php");
if($_SESSION['role']!='Medical Team(MT)'){
    header("Location: login.php");
}
?>
<?php 

?>
<h3>Med Team Page</h3>

<?php 
include_once("lib/footer.php")
?>