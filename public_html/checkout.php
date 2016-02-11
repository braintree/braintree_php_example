<?php
require_once("../includes/braintree_init.php");

$amount = $_POST["amount"];
$nonce = $_POST["payment_method_nonce"];

$result = Braintree\Transaction::sale([
    'amount' => $amount,
    'paymentMethodNonce' => $nonce
]);

if ($result->success){
    $transaction = $result->transaction;
    header("Location: transaction.php?id=" . $transaction->id);
} elseif (!is_null($result->transaction)){
    $transaction = $result->transaction;
    $_SESSION["errors"] = "Transaction status - " . $result->transaction->status;
    header("Location: transaction.php?id=" . $transaction->id);
} else {
    $errorString = "";

    foreach($result->errors->deepAll() AS $error) {
        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
    }

    $_SESSION["errors"] = $errorString;
    header("Location: index.php");
}
