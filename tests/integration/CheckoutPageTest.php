<?php
require_once("tests/TestHelper.php");

class CheckoutPageTest extends PHPUnit_Framework_TestCase
{
    function test_createsTransactionRedirectsToTransactionPage()
    {
        $fields = array(
            'amount' => 10,
            'payment_method_nonce' => "fake-valid-nonce"
        );

        $fields_string = "";
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "localhost:3000/checkout.php");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($curl);

        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $redirectUrl = curl_getinfo($curl, CURLINFO_REDIRECT_URL);
        curl_close($curl);

        $this->assertEquals($httpStatus, 302);
        $this->assertRegExp('/\/transaction.php\?id=/', $redirectUrl);
    }

    function test_transactionErrorRedirectsToIndexPage()
    {
        $fields = array(
            'amount' => 10,
            'payment_method_nonce' => "fake-consumed-nonce"
        );

        $fields_string = "";
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "localhost:3000/checkout.php");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);

        $redirectUrl = curl_getinfo($curl, CURLINFO_REDIRECT_URL);
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->assertEquals($httpStatus, 302);
        $this->assertRegExp('/\/index.php/', $redirectUrl);
    }

    function test_transactionErrorDisplaysErrorMessage()
    {
        $fields = array(
            'amount' => 10,
            'payment_method_nonce' => "fake-consumed-nonce"
        );

        $fields_string = "";
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "localhost:3000/checkout.php");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_COOKIEFILE, "/dev/null");
        $output = curl_exec($curl);

        $redirectUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        curl_close($curl);

        $this->assertRegExp('/\/index.php/', $redirectUrl);
        $this->assertRegExp('/Cannot use a paymentMethodNonce more than once./', $output);
    }

    function test_displaysStatusOnProcessorAndGatewayErrors()
    {
        $fields = array(
            'amount' => 2000,
            'payment_method_nonce' => "fake-valid-nonce"
        );

        $fields_string = "";
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "localhost:3000/checkout.php");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_COOKIEFILE, "/dev/null");
        $output = curl_exec($curl);

        $redirectUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        curl_close($curl);

        $this->assertRegExp('/\/transaction.php\?id=/', $redirectUrl);
        $this->assertRegExp('/Transaction status - processor_declined/', $output);
    }
}
