<?php
session_start();
require_once("vendor/autoload.php");

if(file_exists(__DIR__ . "/../.env")) {
    $dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
    $dotenv->load();
}

$gateway = new Braintree\Gateway([
    'environment' => getenv('BT_ENVIRONMENT'),
    'merchantId' => getenv('BT_MERCHANT_ID'),
    'publicKey' => getenv('BT_PUBLIC_KEY'),
    'privateKey' => getenv('BT_PRIVATE_KEY')
]);
