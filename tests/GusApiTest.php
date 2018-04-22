<?php

namespace GusApi\Tests;

use GusApi\Client\GusApiClient;
use GusApi\GusApi;
use GusApi\Type\Login;
use GusApi\Type\LoginResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GusApiTest extends TestCase
{
    protected $userKey = '123absdefg123';

    /**
     * @var MockObject
     */
    protected $apiClient;

    /**
     * @var GusApi
     */
    protected $api;

    public function setUp()
    {
        $this->apiClient = $this->createMock(GusApiClient::class);
        $this->api = GusApi::createWithApiClient($this->userKey, $this->apiClient);
    }

    public function testLogin()
    {
        $this->apiClient
            ->method('login')
            ->with(
                $this->equalTo(new Login($this->userKey))
            )
            ->willReturn(new LoginResponse('12sessionid21'));

        $this->assertTrue($this->api->login());
    }

    /**
     * @expectedException \GusApi\Exception\InvalidUserKeyException
     */
    public function testInvalidLogin()
    {
        $this->apiClient
            ->method('login')
            ->with(
                $this->equalTo(new Login($this->userKey))
            )
            ->willReturn(new LoginResponse(''));

        $this->api->login();
    }
}
