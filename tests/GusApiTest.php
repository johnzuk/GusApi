<?php

namespace GusApi\Tests;

use GusApi\GusApi;
use PHPUnit\Framework\TestCase;

class GusApiTest extends TestCase
{
    /*public function testLoginGus()
    {
        $gus = new GusApi('abcde12345abcde12345');
        $this->assertInternalType('string', $gus->login());
    }*/

    /**
     * @expectedException \GusApi\Exception\InvalidUserKeyException
     */
    /*public function testLoginInvalidKey()
    {
        $gus = new GusApi('abcdefghijklmnno');
        $gus->login();
    }*/
}
