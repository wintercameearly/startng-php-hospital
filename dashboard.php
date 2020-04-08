<?php  include_once('lib/header.php');

if(!isset($_SESSION['loggedIn'])){
    header("Location: login.php");
}
?>
<?php 

//To check for login date and time 
$allLogs = scandir("db/logs/");


$countLogs = count($allLogs);

for ($counter =0; $counter <= $countLogs; $counter++){
    $currentUser = $allLogs[$counter];
    $email = $_SESSION['email'];
    if($currentUser == $email. ".json"){
        $detailString = file_get_contents("db/logs/".$currentUser);
        $userObject = json_decode($detailString);
        $lastlogindate = $userObject->date;
        $lastlogintime = $userObject->time;
    }
    }
?>


<h3>Dashboard</h3>
Welcome, <?php echo $_SESSION['fullname']; ?>
<hr>
You are logged in as (<?php echo $_SESSION['role'] ?>),in <?php echo $_SESSION['department'] ?> Department. Your user ID is <?php echo $_SESSION['loggedIn'] ?> <br>
<hr>
You were registered on <?php echo $_SESSION['registrationdate'] ?>
<br>
<hr>
You last logged in on <?php echo $lastlogindate?> at <?php echo $lastlogintime ?>

<?php include_once('lib/footer.php'); ?>