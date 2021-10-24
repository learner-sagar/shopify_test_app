<?php 
require_once("./config/database.php");
include_once("./config/App.php");

$app = new App();
$parameters = $_GET;

include_once('./config/check_token.php');

$script_tags = $app->rest_call('/admin/api/2021-10/script_tags.json',array(),'GET');
$script_tags = json_decode($script_tags['body'], true);
print_r($script_tags);

