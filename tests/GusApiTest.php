<?php

use Gus\GusApi\GusApi\GusApi;

class GusApiTest extends PHPUnit_Framework_TestCase
{
    public function testLoginGus()
    {
        $gus = new GusApi();
        $this->assertEquals($gus,$gus->login());
    }
}
