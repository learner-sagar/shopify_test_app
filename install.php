<?php
    $app_url = "https://a054-2402-8100-238c-643f-5940-6b3-1921-9c58.ngrok.io";
    $shop = $_GET['shop'];
    $api_key = "1fac0f2fa86afd2304d49859712b3f20";
    $scopes = "read_orders,write_orders,read_products,write_products,read_script_tags,write_script_tags";
    $redirect_uri = $app_url . "/shopify/token.php";
    $nonce = bin2hex(random_bytes(12));
    $access_mode = 'per-user';
    $oauth_url = "https://".$shop."/admin/oauth/authorize?client_id=".$api_key."&scope=".$scopes."&redirect_uri=".$redirect_uri."&state=".$nonce."&grant_options[]=".$access_mode;
    header("Location: ".$oauth_url);
    exit();
?>