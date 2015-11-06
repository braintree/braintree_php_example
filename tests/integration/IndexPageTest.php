<?php
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
}
