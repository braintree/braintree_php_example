<?php
require_once("tests/TestHelper.php");

class TransactionPageTest extends PHPUnit_Framework_TestCase
{
    function test_showsTransactionInformation()
    {
        $result = Braintree\Transaction::sale([
            'amount' => 10,
            'paymentMethodNonce' => 'fake-valid-nonce'
        ]);
        $transaction = $result->transaction;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "localhost:3000/transaction.php?id=" . $transaction->id);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);

        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->assertEquals($httpStatus, 200);
        $this->assertContains($transaction->id, $output);
        $this->assertContains($transaction->type, $output);
        $this->assertContains($transaction->amount, $output);
        $this->assertContains($transaction->status, $output);
        $this->assertContains($transaction->creditCardDetails->bin, $output);
        $this->assertContains($transaction->creditCardDetails->last4, $output);
        $this->assertContains($transaction->creditCardDetails->cardType, $output);
        $this->assertContains($transaction->creditCardDetails->expirationDate, $output);
        $this->assertContains($transaction->creditCardDetails->customerLocation, $output);
    }
}
