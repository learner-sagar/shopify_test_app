<?php
require_once("./config/database.php");
$api_key = "1fac0f2fa86afd2304d49859712b3f20";
$secret_key = "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";
$parameters = $_GET;
$hmac = $parameters['hmac'];
$shop_url = $parameters['shop'];
$parameters = array_diff_key($parameters,array("hmac" => ''));
ksort($parameters);

$new_hmac = hash_hmac('sha256',http_build_query($parameters),$secret_key);

if(hash_equals($hmac,$new_hmac)){
    $access_token_endpoint = "https://".$shop_url."/admin/oauth/access_token";
    $variables = array(
        "client_id" => $api_key,
        "client_secret" => $secret_key,
        "code" => $parameters["code"]
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $access_token_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, count($variables));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($variables));
    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response,true);
    print_r($response);

    $query = "insert into stores (store_url,access_token,create_date) values ('".$parameters['shop']."' , '".$response['access_token']."','".date('Y-m-d H:i:s')."') on duplicate key update access_token='".$response['access_token']."'";
    if(mysqli_query($mysql,$query)){
    
    }else{
        echo "an error occured";
    }
}else{
    print_r("invalid");
}
