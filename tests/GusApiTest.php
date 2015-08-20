<?php

use GusApi\GusApi;

class GusApiTest extends PHPUnit_Framework_TestCase
{
    public function testLoginGus()
    {
        $gus = new GusApi("aaaaaabbbbbcccccdddd");
        $this->assertTrue(is_string($gus->login()));
    }

    public function testGetCaptcha()
    {
        $gus = new GusApi("aaaaaabbbbbcccccdddd");
        $sid = $gus->login();

        $this->assertNotEquals(-1, $gus->getCaptcha($sid));
    }

    /**
     * @expectedException GusApi\Exception\InvalidUserKeyException
     */
    public function testLoginInvalidKay()
    {
        $gus = new GusApi("abcdefghijklmnno");
        $sid = $gus->login();
    }
}
