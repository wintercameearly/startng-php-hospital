<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Transaction details 
$appointment_dept = $_POST['department'];

$amount = $_POST['amount'];

$_SESSION['amount']=$amount;
$_SESSION["appointment_dept"]=$appointment_dept;

// Customer details 
$fullname = $_SESSION['fullname'];
$email = $_SESSION['email'];
$role = $_SESSION['role'] ;

// Produce text reference
function genTxref() {
    $txref = "txref_";
    for ($i = 0; $i < 7; $i++) {
        $txref .= mt_rand(0, 6);
    }
    return $txref;
}

$ref = genTxref();

// Payment Process

$curl = curl_init();

$customer_email = $email;
$amount = $amount;  
$currency = "NGN";
$txref = $ref; // ensure you generate unique references per transaction.
$PBFPubKey = ""; // get your public key from the dashboard.
$redirect_url = "http://localhost/snh/verifybill.php";
//$redirect_url = "http://localhost/snh/bill.php";


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'customer_email'=>$customer_email,
    'currency'=>$currency,
    'txref'=>$txref,
    'PBFPubKey'=>$PBFPubKey,
    'redirect_url'=>$redirect_url
  ]),
  CURLOPT_HTTPHEADER => [
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the rave API
  die('Curl returned error: ' . $err);
}

$transaction = json_decode($response);

if(!$transaction->data && !$transaction->data->link){
  // there was an error from the API
  print_r('API returned error: ' . $transaction->message);
}
// uncomment out this line if you want to redirect the user to the payment page
//print_r($transaction->data->message);


// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $transaction->data->link);


?>
