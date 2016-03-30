<?php
require_once("tests/TestHelper.php");

class IndexPageTest extends PHPUnit_Framework_TestCase
{
    function test_returnsHttpSuccess()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "localhost:3000");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($curl);

        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->assertEquals($httpStatus, 200);
    }

    function test_clientTokenOnPage()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "localhost:3000");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        $this->assertRegExp('/var client_token = ".*";/', $output);
    }

    function test_checkoutFormOnPage()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "localhost:3000");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);

        $this->assertRegExp('/<form method="post" id="payment-form"/', $output);
        $this->assertRegExp('/<div id="bt-dropin"/', $output);
        $this->assertRegExp('/<input id="amount" name="amount" type="tel"/', $output);
    }

}
