<?php
require_once("ADMIN.php");

$token = "1SsVEWlWELIZK5rxcu6erN0QEaffK3H85I5M_5i15IHJNcIBfic0kJdzGpy";
$debug = false;

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if($debug)
    echo $postdata;

@$action = $request->action;
@$data = $request->data;


function generateRandomString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}


// Init cURL
$request = curl_init();

// Set request options
curl_setopt_array($request, array
(
  CURLOPT_URL => $data->url,
  CURLOPT_POST => TRUE,
  CURLOPT_POSTFIELDS => http_build_query(array
    (
      'cmd' => '_notify-synch',
      'tx' => $data->tx,
      'at' => $token,
    )),
  CURLOPT_RETURNTRANSFER => TRUE,
  CURLOPT_HEADER => FALSE,
  // CURLOPT_SSL_VERIFYPEER => TRUE,
  // CURLOPT_CAINFO => 'cacert.pem',
));

// Execute request and get response and status code
$response = curl_exec($request);
$status   = curl_getinfo($request, CURLINFO_HTTP_CODE);

// Close connection
curl_close($request);

if (strpos($response, 'SUCCESS') !== false) {
  $auth_code = generateRandomString(128);  
  $data->auth_code = $auth_code;
  $data->response = $response;

  $acc = new ADMIN();
  $auth_code = $acc->completePurchase($data);  

  $compare = $_COOKIE['auth_code'];

  if($auth_code != $compare){
    $auth_code = NULL;
  }

  $result = array(
    'success'           => 1,
    'purchase_auth'     => $auth_code,
    'cookie'            => $_COOKIE['auth_code'],
    'pp_id' => $data->pp_id,
    'tx_id' => $data->tx,
    'session_pp_id' => $_SESSION['pp_id']
  ); 
}else{
  $result = array(
    'success'           => 0,
    'purchase_auth'     => NULL,
    'cookie'            => NULL,
    'pp_id' => NULL,
    'tx_id' => NULL
  ); 
}

echo json_encode($result);

// echo $response;
?>