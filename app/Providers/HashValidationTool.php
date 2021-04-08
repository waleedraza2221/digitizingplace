<?php

namespace App\Providers;

class HashValidationTool
{

 public function getInvoiceInfo($refno){


    $merchantCode = "250278707506";   
    $key = "Z%^H@GwDVIQAny=3O!8?"; 
    $apiVersion = '6.0'; 
    $resource = 'orders';
    $host = "https://api.2checkout.com/rest/".$apiVersion."/".$resource."/".$refno;
    $date = gmdate('Y-m-d H:i:s');
    $string = strlen($merchantCode) . $merchantCode . strlen($date) . $date; 
    $hash = hash_hmac('md5', $string, $key);
    $payload = '';
    $ch = curl_init();
    $headerArray = array(
    
        "Content-Type: application/json",
    
        "Accept: application/json",
   
        "X-Avangate-Authentication: code=\"{$merchantCode}\" date=\"{$date}\" hash=\"{$hash}\"",
    
        'Cookie: XDEBUG_SESSION=PHPSTORM'
    
    );
    
     
    
    curl_setopt($ch, CURLOPT_URL, $host);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    
    curl_setopt($ch, CURLOPT_POST, FALSE);
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    
    curl_setopt($ch, CURLOPT_SSLVERSION, 0);
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
   
     
   
    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
 }

   
  
}
