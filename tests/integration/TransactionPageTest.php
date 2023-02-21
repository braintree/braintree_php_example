<?php
require_once("tests/TestHelper.php");

class TransactionPageTest extends PHPUnit\Framework\TestCase
{
    function test_showsTransactionInformation()
    {
        global $gateway;
        $result = $gateway->transaction()->sale([
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
        $this->assertStringContainsString($transaction->id, $output);
        $this->assertStringContainsString($transaction->type, $output);
        $this->assertStringContainsString($transaction->amount, $output);
        $this->assertStringContainsString($transaction->status, $output);
        $this->assertStringContainsString($transaction->creditCardDetails->bin, $output);
        $this->assertStringContainsString($transaction->creditCardDetails->last4, $output);
        $this->assertStringContainsString($transaction->creditCardDetails->cardType, $output);
        $this->assertStringContainsString($transaction->creditCardDetails->expirationDate, $output);
        $this->assertStringContainsString($transaction->creditCardDetails->customerLocation, $output);
    }
}
