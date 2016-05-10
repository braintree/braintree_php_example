<?php
require_once("tests/TestHelper.php");

class CheckoutPageTest extends PHPUnit_Framework_TestCase
{
    function test_createsTransactionRedirectsToTransactionPage()
    {
        $non_duplicate_amount = rand(1,100) . "." . rand(1,99);
        $fields = array(
            'amount' => $non_duplicate_amount,
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

    function test_displaysSuccessMessageWhenTransactionSuceeded()
    {
        $non_duplicate_amount = rand(1,100) . "." . rand(1,99);
        $fields = array(
            'amount' => $non_duplicate_amount,
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
        $output = curl_exec($curl);

        $redirectUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        curl_close($curl);

        $this->assertRegExp('/\/transaction.php\?id=/', $redirectUrl);
        $this->assertRegExp('/Sweet Success!/', $output);
        $this->assertRegExp('/Your test transaction has been successfully processed./', $output);
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
        $this->assertRegExp('/Error: 91564: Cannot use a paymentMethodNonce more than once./', $output);
    }

    function test_displaysStatusOnProcessorErrors()
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
        $output = curl_exec($curl);

        $redirectUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        curl_close($curl);

        $this->assertRegExp('/\/transaction.php\?id=/', $redirectUrl);
        $this->assertRegExp('/Transaction Failed/', $output);
        $this->assertRegExp('/Your test transaction has a status of processor_declined./', $output);
    }

    function test_doesNotDisplayCustomerDetailsWhenMissing()
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
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $output = curl_exec($curl);

        $redirectUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        curl_close($curl);

        $this->assertNotRegExp('/Customer Details/', $output);
    }
}
