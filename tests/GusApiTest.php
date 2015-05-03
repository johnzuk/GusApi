<?php

use GusApi\GusApi;

class GusApiTest extends PHPUnit_Framework_TestCase
{
    public function testLoginGus()
    {
        $gus = new GusApi();
        $this->assertTrue(is_string($gus->login()));
    }

    public function testGetCaptcha()
    {
        $gus = new GusApi();
        $sid = $gus->login();

        $this->assertNotEquals(-1, $gus->getCaptcha($sid));
    }
}
