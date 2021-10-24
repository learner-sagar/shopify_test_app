<?php 

$query = "select * from stores where store_url = '".$parameters['shop']."' limit 1";
$result = mysqli_query($mysql,$query);

if(mysqli_num_rows($result) < 1){
    header("Location: install.php?shop=".$parameters['shop']);
    exit();
}

$store_data  = mysqli_fetch_assoc($result);
$app->set_url($parameters['shop']);
$app->set_token($store_data['access_token']);

$response = $app->rest_call("/admin/oauth/access_scopes.json",array(),'GET');

$response = json_decode($response['body'], true);
if(array_key_exists('errors',$response)){
    echo 'Sorry there is an error in your api call spcifically: '.$response['errors'];
    header("Location: install.php?shop=".$parameters['shop']);
    exit();
}