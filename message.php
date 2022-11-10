<?php

include('tailored.php');
 //check if the user as subsribed for the last 2 days
if ($ResultCode ==0){
 $conn = mysqli_connect("localhost", "u825147531_voucher", "6~Aa#:1;7O:", "u825147531_voucher"); 
  
 
$phone="+".$PhoneNumber;
 
$username = 'Splynx'; // use 'sandbox' for development in the test environment
$apiKey   = 'b6811b50ca4e228ccb1d94c1be5e15f2bf4e51565ee3b4d5fb26ea74494b3c4a'; // use your sandbox app API key for development in the test environment 
$AT       = new AfricasTalking($username, $apiKey);
$sms      = $AT->sms();
 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    $sql ="SELECT COUNT(*) as variable, DATE_FORMAT(datec, '%m/%d/%y') FROM recordstable WHERE datec BETWEEN (CURDATE() - INTERVAL 30 DAY) AND CURDATE() and phone='$phone'";
$reward = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($reward) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($reward)) {
        $reward = $row["variable"];
echo $reward;
$ncount= 7-$reward;
$vendor='Omada TPLink';

if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}


 

if (mysqli_num_rows($res) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($res)) {
 
  
//plan 20 statrts here
if ($Amount == 1 && $reward<=3) {
  $sql = "INSERT INTO recordstable (amount, phone, code ,date) VALUES ('$Amount', '$phone', '$c20','$date')";
 mysqli_query($conn, $sql);
 $result   = $sms->send([
    'to'      => $phone,
     'message' =>'You have Successfully subscribed to 2mbps unlimited internet valid for 4 hours',
    'from'       => 'SkyTrend'
]);

   $result   = $sms->send([
    'to'      => $phone,
     'message' => $c20 ,
    'from'       => 'SkyTrend'
]);
 
 

 $result1 = json_encode($result);
print_r($result1);
$result2=json_decode($result1);
$statusw=$result2->data->SMSMessageData->Recipients[0]->status;
$mobile=$result2->data->SMSMessageData->Recipients[0]->number;
$costa=$result2->data->SMSMessageData->Recipients[0]->cost;
$sql = "INSERT INTO sms_status (phone, status, cost, code, amount, date, vendor) VALUES ('$mobile', '$statusw', '$costa',  '$c20','$Amount','$date','$vendor')";
 mysqli_query($conn, $sql);

 $sql = "DELETE  FROM plan20 WHERE ccode20='$c20'";

 mysqli_query($conn, $sql);

}
 //reward for user subscribing for fourth time
elseif($Amount==1 && $reward >=4){

    
  $result   = $sms->send([
    'to'      => $phone,
     'message' => 'Congratulations you have entered our lucky draw! make ' .$ncount. ' more subscriptions and get 6mbps valid for 24 hours for free ',
    'from'       => 'SkyTrend'
]); 
$result   = $sms->send([
    'to'      => $phone,
     'message' => $c20 ,
    'from'       => 'SkyTrend'
]);
$sql = "INSERT INTO recordstable (amount, phone, code ,date) VALUES ('$Amount', '$phone', '$c20','$date')";
mysqli_query($conn, $sql);

$result1 = json_encode($result);
print_r($result1);
$result2=json_decode($result1);
$statusw=$result2->data->SMSMessageData->Recipients[0]->status;
$mobile=$result2->data->SMSMessageData->Recipients[0]->number;
$costa=$result2->data->SMSMessageData->Recipients[0]->cost;
$sql = "INSERT INTO sms_status (phone, status, cost, code, amount, date, vendor) VALUES ('$mobile', '$statusw', '$costa',  '$c20','$Amount','$date','$vendor')";
 mysqli_query($conn, $sql);
 
 $sql = "DELETE  FROM plan20 WHERE ccode20='$c20'";
 mysqli_query($conn, $sql);
 }
 
 ///plan 30 starts
 elseif ($Amount == 30 && $reward<=3) {
  $sql = "INSERT INTO recordstable (amount, phone, code ,date) VALUES ('$Amount', '$phone', '$c30','$date')";
 mysqli_query($conn, $sql);
 $result   = $sms->send([
    'to'      => $phone,
     'message' =>'You have Successfully subscribed to 3mbps unlimited internet valid for 6 hours',
    'from'       => 'SkyTrend'
]);

   $result   = $sms->send([
    'to'      => $phone,
     'message' => $c30 ,
    'from'       => 'SkyTrend'
]);
 
 

 $result1 = json_encode($result);
print_r($result1);
$result2=json_decode($result1);
$statusw=$result2->data->SMSMessageData->Recipients[0]->status;
$mobile=$result2->data->SMSMessageData->Recipients[0]->number;
$costa=$result2->data->SMSMessageData->Recipients[0]->cost;
$sql = "INSERT INTO sms_status (phone, status, cost, code, amount, date, vendor) VALUES ('$mobile', '$statusw', '$costa',  '$c30','$Amount','$date','$vendor')";
 mysqli_query($conn, $sql);

 $sql = "DELETE  FROM plan30 WHERE ccode30='$c30'";

 mysqli_query($conn, $sql);

}
 
 

}}
     
}
    }}
 
?>