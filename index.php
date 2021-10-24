<?php
require_once("./config/database.php");
include_once("./config/App.php");


$app = new App();
$parameters = $_GET;

/**
 * ==============================================
 *      CHECK FOR SHOPIFY STORE
 * ==============================================
 */
    include_once('./config/check_token.php');


    $response = $app->rest_call("/admin/oauth/access_scopes.json",array(),'GET');
    $response = json_decode($response['body'], true);
    print_r($response);
?>