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
<h4>Previous Transactions</h3>
<?php 
// Patients Transactions
    //Show paid bills
    $UserBills = scandir("db/bills/"); // return @array (2 filled)
    $countBills = count($UserBills);
    // Count through all the bill folders
    for ($counter =3; $counter < $countBills; $counter++){
        $currentUser = $UserBills[$counter];
        if($currentUser==$_SESSION['email']){
            $currentUserBills = scandir("db/bills/".$currentUser."/");
            $countCurrentUBills = count($currentUserBills);
            for ($counter =3; $counter < $countCurrentUBills; $counter++){
                $bill=$currentUserBills[$counter];
                $billString = file_get_contents("db/bills/".$currentUser."/".$bill);
                $billObject = json_decode($billString);

                $fullname = $billObject->fullname;
                $amount = $billObject->amount;
                $dt = $billObject->time;
                $pay_date = date('Y-m-d H:i:s', $dt);
                $appointment_dept = $billObject->appointment_dept;
            ?>
                <li class="list-group-item"> |<span class="badge badge-secondary"> Amount Paid: </span>  <?php echo $billObject->amount;  ?> <span class="badge badge-secondary"> Payment Date: </span>  <?php echo $pay_date  ?> <span class="badge badge-secondary"> Department: </span>  <?php echo $appointment_dept  ?></li>
            <?php 
            }
        }
    }
?>
<?php 
include_once("lib/footer.php")
?>

