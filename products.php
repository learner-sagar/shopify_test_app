<?php 
require_once("./config/database.php");
include_once("./config/App.php");

$app = new App();
$parameters = $_GET;

include_once('./config/check_token.php');

$products = $app->rest_call('/admin/api/2021-10/products.json',array(),'GET');
$products = json_decode($products['body'], true);
print_r($products);

