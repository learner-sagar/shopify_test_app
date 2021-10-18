<?php
require_once("./config/database.php");
include_once("./config/App.php");

$app = new App();

$parameters = $_GET;
$query = "select * from stores where store_url = '".$parameters['shop']."' limit 1";
$result = mysqli_query($mysql,$query);

if(mysqli_num_rows($result) < 1){
    header("Location: install.php?shop=".$parameters['shop']);
    exit();
}

$store_data  = mysqli_fetch_assoc($result);
$app->set_url($parameters['shop']);
$app->set_token($store_data['access_token']);

echo $app->get_url();
echo "<br>";
echo $app->get_token();
echo "<br>";

$products = $app->rest_call("/admin/api/2021-10/products.json",array(),'GET');

print_r($products);

?>