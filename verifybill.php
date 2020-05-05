<?php 
//Check for session status and start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
$amount = $_SESSION['amount'];

require_once('functions/alert.php');
require_once('functions/users.php');
require_once('functions/email.php');
require_once('functions/redirect.php');
require_once('functions/token.php');
?>
<?php
    if (isset($_GET['txref'])) {
        $ref = $_GET['txref'];
        $amount = $amount; //Correct Amount from Server
        $currency = "NGN"; //Correct Currency from Server

        $query = array(
            "SECKEY" => "FLWSECK_TEST-7b8f9b3f5d31fb68aa03be885b802acc-X",
            "txref" => $ref
        );

        $data_string = json_encode($query);
                
        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
            // Users could have made multiple transactions
            // Create a timestamp and use it to in each individual transaction in the db, inside a folder with thier email 
            $currentTime = time();
            // Take user details from session 
            $fullname= $_SESSION['fullname'];
            $email= $_SESSION['email'];
            $role= $_SESSION['role'];
            $amount= $_SESSION['amount'];
            $appointment_dept = $_SESSION['appointment_dept'];
            //Creat an object that stores user details 
            $appointmentObject = ['fullname'=>$fullname,
                                  'email'=>$email,
                                  'role'=>$role,
                                  'amount'=>$amount,
                                  'appointment_dept'=>$appointment_dept,
                                  'time'=>$currentTime,
                                ];
            // Create an id for each bill
            $UserBills = scandir("db/bills/".$email."/"); // return @array (2 filled)
            $countBills = count($UserBills);
            // Bill Id
            $newBillId = ($countBills - 1);

            // Do some checks and add a log of the bill, based on the timestamp
            if(!is_dir("db/bills/".$email)){
                mkdir("db/bills/".$email);
                if(!file_exists("db/bills/".$email."/".$newBillId.".json")){
                file_put_contents("db/bills/".$email."/".$newBillId.".json",json_encode($appointmentObject));}
            }else{
                file_put_contents("db/bills/".$email."/".$newBillId.".json",json_encode($appointmentObject));
            }
            //Add paid block to users appointment file 
            $allApps = scandir("db/appointments/"); // return @array (2 filled)
            $countAllApps = count($allApps);
            for ($counter =0; $counter < $countAllApps; $counter++){
                $currentApp = $allApps[$counter];
                if($currentApp == $email. ".json"){
                    $AppObject = json_decode(file_get_contents("db/appointments/".$currentApp));
                    $AppObject->paid = "True";
                    $AppObject->amount = $amount;
                    unlink("db/appointments/.$email");
                    file_put_contents("db/appointments/".$email. ".json", json_encode($AppObject));         
                }
            } 
            // Send a success email to the user 
            $subject = "Successful Payment";
            $message = "Your recent payment for".$appointment_dept."was successful";
            $email = $email;
            $headers = "me";
            mail($email,$subject,$message,$headers);
            set_alert("message","Payment Successful");

            //Redirect to patients page
            redirect_to("bill.php");
        } else {
            //Dont Give Value and return to Failure page
            set_alert("error","Payment failed");
            redirect_to("bill.php");
        }
    }
        else {
      die('No reference supplied');
    }

?>