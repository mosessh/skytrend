

<?php

if (isset($_POST['submit'])) {

  $phone = $_POST['phone'];
$amount =$_POST['amount'];

  $phone = (substr($phone, 0, 1) == "+") ? str_replace("+", "", $phone) : $phone;
  $phone = (substr($phone, 0, 1) == "0") ? preg_replace("/^0/", "254", $phone) : $phone;
  $phone = (substr($phone, 0, 1) == "7") ? "254{$phone}" : $phone;


  date_default_timezone_set('Africa/Nairobi');

  # access token
  $consumerKey = 'X48ov67GPXKmyWMkkkgFescK3lMNydRb'; //Fill with your app Consumer Key
  $consumerSecret = 'LGp5DGAA6QGfF5kx'; 
  $BusinessShortCode = '4092995';
  $Passkey = '79ba5348dc786743e77ba4c6cf9c8113eacd9601fbb0f0473811e495b69191f4';  
 
  $PartyA = $phone; // This is your phone number, 
  $AccountReference = 'Skytrend pay';
  $TransactionDesc = 'CustomerPayBillOnline';
  $Amount = $amount;
 
  $Timestamp = date('YmdHis');    
  
  # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
  $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

  # header for access token
  $headers = ['Content-Type:application/json; charset=utf8'];

    # M-PESA endpoint urls
  $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

  # callback url
  $CallBackURL = 'https://skytrendnetworks.com/stn/res.php';  

  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;  
  curl_close($curl);

  # header for stk push
  $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

  # initiating the transaction
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
//print_r($curl_response);

 // echo $curl_response
header( "refresh:0;url=checking.php" );

} 
  
  
  
?>











 
