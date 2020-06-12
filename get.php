<?php
set_time_limit(0);
$curl = curl_init();
$api_key = "e07825fee157e94745b2c7d0e31c5953";
$type = $_GET['type'];
$param = $type."?".$_GET['param'];

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/".$param,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  // CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "key: $api_key"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}