<?php

  ignore_user_abort();
  ob_start();

  $url = 'https://fcm.googleapis.com/fcm/send';

$Token = 'YOUR-TOKEN';

  $fields = array('to' => $Token ,
   'data' => array('Objetos' => 'Mesa-silla-escritorio'));

  define('GOOGLE_API_KEY', 'AIzaSyAZju9O7kX9b-LvsHVqepChdWQlr54HKMc');

  $headers = array(
          'Authorization:key='.GOOGLE_API_KEY,
          'Content-Type: application/json'
  );      

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

  $result = curl_exec($ch);
  if($result === false)
    die('Curl failed ' . curl_error());
  curl_close($ch);
  return $result;
?>