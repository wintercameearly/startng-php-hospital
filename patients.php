<?php 

include_once("lib/header.php");
if($_SESSION['role']!='Patients'){
    header("Location: login.php");
}
?>
<h3>Patients Page</h3>
<br>
<?php print_alert(); ?>
<a class="btn btn-lg btn-success" href="appointment.php" role="button">Book an Appointment</a> |

<a class="btn btn-lg btn-success" href="bill.php" role="button" >Pay Bills</a></button>
<?php 

?>

<?php 
include_once("lib/footer.php")
?>