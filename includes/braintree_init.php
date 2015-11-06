<?php
session_start();
require_once("../vendor/autoload.php");

$dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
$dotenv->load();

Braintree\Configuration::environment(getenv('BT_ENVIRONMENT'));
Braintree\Configuration::merchantId(getenv('BT_MERCHANT_ID'));
Braintree\Configuration::publicKey(getenv('BT_PUBLIC_KEY'));
Braintree\Configuration::privateKey(getenv('BT_PRIVATE_KEY'));
