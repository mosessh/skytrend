   




 <?php
header("Content-Type: application/json");
    $mpesaResponse = file_get_contents('php://input');
 
    $logFile = "M_PESAConSTNProductionUSSD.txt";
 
    $log = fopen($logFile, "a");

    fwrite($log, $mpesaResponse);
    fclose($log);

require 'vendor/autoload.php';

use AfricasTalking\SDK\AfricasTalking;
$ResultCode='0'; 
$callbackData=json_decode($mpesaResponse);
$ResultCode=$callbackData->Body->stkCallback->ResultCode;
$Amount=$callbackData->Body->stkCallback->CallbackMetadata->Item[0]->Value;
 
$recipient=$callbackData->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$date=$callbackData->Body->stkCallback->CallbackMetadata->Item[4]->Value;
$PhoneNumber=$callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value;
if ($ResultCode ==0){

  $conn = mysqli_connect("localhost", "u825147531_voucher", "6~Aa#:1;7O:", "u825147531_voucher"); 
 
 

  $sql ="INSERT INTO payments(Amount,PhoneNumber,TransactionDate,mpesarecipient) VALUES('$Amount','$PhoneNumber','$date','$recipient')";
  mysqli_query($conn, $sql);
  $PhoneNumber6='254746104716';
$phone="+".$PhoneNumber6;
 
$username = 'Splynx'; // use 'sandbox' for development in the test environment
$apiKey   = 'b6811b50ca4e228ccb1d94c1be5e15f2bf4e51565ee3b4d5fb26ea74494b3c4a'; // use your sandbox app API key for development in the test environment 
$AT       = new AfricasTalking($username, $apiKey);
$sms      = $AT->sms();
 



if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    $sql ="SELECT COUNT(*) as variable, DATE_FORMAT(datec, '%m/%d/%y') FROM payments WHERE datec BETWEEN (CURDATE() - INTERVAL 30 DAY) AND CURDATE() and PhoneNumber='$PhoneNumber6'";
$reward = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($reward) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($reward)) {
        $reward = $row["variable"];




echo $reward;

//$vendor='Omada TPLink';

if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}


//SELECT code FROM plan50 ORDER BY Rand() LIMIT 1SELECT plan50.code,plan100.code100, plan150.code150
$sql = "SELECT * from plan30,plan50,plan90 ORDER BY Rand() LIMIT 1";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($res)) {
$c90= $row["ccode90"];
$c30= $row["ccode30"];
$c50= $row["ccode50"];
$Amount=1;
  

if ($Amount == 1 && $reward<=1) {
  $sql = "INSERT INTO recordstable (amount, phone, code ,date) VALUES ('$Amount', '$phone', '$uniqueKey','$date')";
 mysqli_query($conn, $sql);
 $result   = $sms->send([
    'to'      => $phone,
     'message' =>'You have Successfully subscribed to 2mbps unlimited internet valid for 6 hours',
    'from'       => 'SkyTrend'
]);

   $result   = $sms->send([
    'to'      => $phone,
     'message' => $c30 ,
    'from'       => 'SkyTrend'
]);
 
$sql = "DELETE  FROM plan30 WHERE ccode30='$c30'";

mysqli_query($conn, $sql);
 
//$q = "DELETE FROM 'plan10' WHERE 'code10' =$c10";
//$conn->exec($q);

 $result1 = json_encode($result);
print_r($result1);
$result2=json_decode($result1);
$statusw=$result2->data->SMSMessageData->Recipients[0]->status;
$mobile=$result2->data->SMSMessageData->Recipients[0]->number;
$costa=$result2->data->SMSMessageData->Recipients[0]->cost;
 $sql = "INSERT INTO sms_status (phone, status, cost, code, amount, date) VALUES ('$mobile', '$statusw', '$costa',  '$c30','$Amount','$date')";
 mysqli_query($conn, $sql);
}
 //reward for user subscribing for fourth time
elseif($Amount==1 && $reward >=2){
  $result   = $sms->send([
    'to'      => $phone,
     'message' => 'Congratulations you have entered our lucky draw! make three more subscriptions and get 6mbps valid for 24 hours for free ',
    'from'       => 'SkyTrend'
]); 
$result   = $sms->send([
    'to'      => $phone,
     'message' => $c30 ,
    'from'       => 'SkyTrend'
]);
$sql = "INSERT INTO recordstable (amount, phone, code ,date) VALUES ('$Amount', '$phone', '$c30','$date')";
mysqli_query($conn, $sql);
$sql = "DELETE  FROM plan30 WHERE ccode30='$c30'";

mysqli_query($conn, $sql);
$result1 = json_encode($result);
print_r($result1);
$result2=json_decode($result1);
$statusw=$result2->data->SMSMessageData->Recipients[0]->status;
$mobile=$result2->data->SMSMessageData->Recipients[0]->number;
$costa=$result2->data->SMSMessageData->Recipients[0]->cost;
$sql = "INSERT INTO sms_status (phone, status, cost, code, amount, date) VALUES ('$mobile', '$statusw', '$costa',  '$c30','$Amount','$date')";
 mysqli_query($conn, $sql);
 }
//check amount paid if its equal to 50 and reward is less than 3
elseif ($Amount == 50 && $reward<=1) {
$sql = "INSERT INTO recordstable (amount, phone, code ,date) VALUES ('$Amount', '$phone', '$uniqueKey','$date')";
mysqli_query($conn, $sql);
$result   = $sms->send([
    'to'      => $phone,
    'message' =>'You have Successfully subscribed to 4mbps unlimited internet valid for 10 hours your Voucher code is SkyTrend Networks Do more with fastest internet',
      'from'       => 'SkyTrend'
]);
$result   = $sms->send([
    'to'      => $phone,
     'message' =>'   '  .$c50.  '  ',
    'from'       => 'SkyTrend'
]);
$sql = "DELETE  FROM plan50 WHERE ccode50='$c50'";
mysqli_query($conn, $sql);
$result1 = json_encode($result);
print_r($result1);
$result2=json_decode($result1);
$statusw=$result2->data->SMSMessageData->Recipients[0]->status;
$mobile=$result2->data->SMSMessageData->Recipients[0]->number;
$cost=$result2->data->SMSMessageData->Recipients[0]->cost;
$sql = "INSERT INTO sms_status (phone, status, cost, code, amount, date) VALUES ('$mobile', '$statusw', '$costa',  '$c50','$Amount','$date')";
mysqli_query($conn, $sql);
  }
//if reward is greator process this function sent a tailored message

elseif($Amount==5 && $reward>=2){
    $result   = $sms->send([
      'to'      => $phone,
       'message' => 'Congratulations you have entered our lucky draw! make three more subscriptions and get 6mbps valid for 24 hours for free ',
      'from'       => 'SkyTrend'
  ]); 
  $result   = $sms->send([
      'to'      => $phone,
       'message' => $c30 ,
      'from'       => 'SkyTrend'
  ]);
  $sql = "INSERT INTO recordstable (amount, phone, code ,date) VALUES ('$Amount', '$phone', '$c30','$date')";
  mysqli_query($conn, $sql);
  $sql = "DELETE  FROM plan30 WHERE ccode30='$c30'";
  
  mysqli_query($conn, $sql);
  $result1 = json_encode($result);
  print_r($result1);
  $result2=json_decode($result1);
  $statusw=$result2->data->SMSMessageData->Recipients[0]->status;
  $mobile=$result2->data->SMSMessageData->Recipients[0]->number;
  $costa=$result2->data->SMSMessageData->Recipients[0]->cost;
  $sql = "INSERT INTO sms_status (phone, status, cost, code, amount, date) VALUES ('$mobile', '$statusw', '$costa',  '$c30','$Amount','$date')";
   mysqli_query($conn, $sql);
   }
 //plan 90 check if amount paid is equal to amount paid
 elseif ($Amount == 90 && $reward<=1) {
$sql = "INSERT INTO recordstable (amount, phone, code ,date) VALUES ('$Amount', '$phone', '$uniqueKey','$date')";
 mysqli_query($conn, $sql);
$result   = $sms->send([
    'to'      => $phone,
    'message' =>'You have Successfully subscribed to 5mbps unlimited internet valid for 24 hours your Voucher code is  SkyTrend Networks Do more with fastest internet',
      'from'       => 'SkyTrend'
]);
$result   = $sms->send([
    'to'      => $phone,
     'message' =>'   '  .$c90.  '  ',oj
    'from'       => 'SkyTrend'
]);
$sql = "DELETE  FROM plan90 WHERE ccode90='$c90'";
mysqli_query($conn, $sql);
$result1 = json_encode($result);
print_r($result1);
$result2=json_decode($result1);
$statusw=$result2->data->SMSMessageData->Recipients[0]->status;
$mobile=$result2->data->SMSMessageData->Recipients[0]->number;
$cost=$result2->data->SMSMessageData->Recipients[0]->cost;
$sql = "INSERT INTO sms_status (phone, status, cost, code, amount, date) VALUES ('$mobile', '$statusw', '$costa',  '$c90','$Amount','$date')";
mysqli_query($conn, $sql);
}
////reward
elseif($Amount==1 && $reward>=2){
    $result   = $sms->send([
      'to'      => $phone,
       'message' => 'Congratulations you have entered our lucky draw! make three more subscriptions and get 6mbps valid for 24 hours for free ',
      'from'       => 'SkyTrend'
  ]); 
  $result   = $sms->send([
      'to'      => $phone,
       'message' => $c30 ,
      'from'       => 'SkyTrend'
  ]);
  $sql = "INSERT INTO recordstable (amount, phone, code ,date) VALUES ('$Amount', '$phone', '$c30','$date')";
  mysqli_query($conn, $sql);
  $sql = "DELETE  FROM plan30 WHERE ccode30='$c30'";
  
  mysqli_query($conn, $sql);
  $result1 = json_encode($result);
  print_r($result1);
  $result2=json_decode($result1);
  $statusw=$result2->data->SMSMessageData->Recipients[0]->status;
  $mobile=$result2->data->SMSMessageData->Recipients[0]->number;
  $costa=$result2->data->SMSMessageData->Recipients[0]->cost;
  $sql = "INSERT INTO sms_status (phone, status, cost, code, amount, date) VALUES ('$mobile', '$statusw', '$costa',  '$c30','$Amount','$date')";
   mysqli_query($conn, $sql);
   }

}}


  
    
}
    }}
 
?>