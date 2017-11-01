<?php

use GusApi\GusApi;

class GusApiTest extends PHPUnit_Framework_TestCase
{
    public function testLoginGus()
    {
        $gus = new GusApi("abcde12345abcde12345");
        $this->assertTrue(is_string($gus->login()));
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
