<?php 

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "shopify";

    $mysql = mysqli_connect($server,$username,$password,$database);

    if (!$mysql) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>