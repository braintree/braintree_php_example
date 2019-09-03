<?php
session_start();
require_once('../vendor/autoload.php');

if(file_exists(__DIR__ . '/../.env')) {
    $dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
    $dotenv->load();
}

if (!getenv('BT_ENVIRONMENT') || !getenv('BT_MERCHANT_ID') || !getenv('BT_PUBLIC_KEY') || !getenv('BT_PRIVATE_KEY')) {
    throw new Exception('Cannot find necessary environmental variables. See https://github.com/braintree/braintree_php_example#setup-instructions for instructions');
}

$gateway = new Braintree\Gateway([
    'environment' => getenv('BT_ENVIRONMENT'),
    'merchantId' => getenv('BT_MERCHANT_ID'),
    'publicKey' => getenv('BT_PUBLIC_KEY'),
    'privateKey' => getenv('BT_PRIVATE_KEY')
]);
$baseUrl = stripslashes(dirname($_SERVER['SCRIPT_NAME']));
$baseUrl = $baseUrl == '/' ? $baseUrl : $baseUrl . '/';
