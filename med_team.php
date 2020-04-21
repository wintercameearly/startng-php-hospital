<?php 
include_once("lib/header.php");
if($_SESSION['role']!='Medical Team(MT)'){
    header("Location: login.php");
}
?>
<?php 

?>
<h3>Med Team Page|<span class="badge badge-secondary"><?php echo $_SESSION['department']; ?></span> </h3>
<?php 
//Make a count of all appointments 
$allApps = scandir("db/appointments/"); // return @array (2 filled)
$countAllApps = count($allApps);
for ($counter =2; $counter < $countAllApps; $counter++){
    $currentApp = $allApps[$counter];
    $userString = file_get_contents("db/appointments/".$currentApp );
    $userObject = json_decode($userString);
    //Check details of each appointment
    $name=$userObject->name;
    $date=$userObject->date;
    $nat_app=$userObject->nat_app;
    $complaint=$userObject->complaint;
    $p_department=$userObject->department;
?>
<?php 
//If appointment details match with required department, display the details 
if($p_department== $_SESSION['department']){ 
    //Checker value to display Pending or not
    $checker = True;
?>


<!-- Just some fancy formatting for details -->
<br>
<div class= "container">
<ul class="list-group">
  <li class="list-group-item"> <span class="badge badge-secondary"> Patient Name: </span>  <?php echo $name ; ?> |<span class="badge badge-secondary"> Appointment Date: </span>  <?php echo $date;  ?> | <span class="badge badge-secondary">Initial Complaint: </span>  <?php echo $complaint ?>| <span class="badge badge-secondary">Nature of Appointment: </span>  <?php  echo $nat_app; ?> </li>
</ul>
</div>


<?php } ?>  
<?php }  ?>

<?php 
//Simple checker based on checker value created
if($checker=False){
    echo "You have no Pending Appointments";
}
?>


<?php 
include_once("lib/footer.php");
?>