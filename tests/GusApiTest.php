<?php

namespace GusApi\Tests;

use GusApi\Client\GusApiClient;
use GusApi\GusApi;
use GusApi\Type\Request\GetValue;
use GusApi\Type\Request\Login;
use GusApi\Type\Request\Logout;
use GusApi\Type\Response\GetValueResponse;
use GusApi\Type\Response\LoginResponse;
use GusApi\Type\Response\LogoutResponse;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GusApiTest extends TestCase
{
    protected $userKey = '123absdefg123';
    protected $sessionId = '12sessionid21';

    /**
     * @var MockObject|GusApiClient
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
            ->expects($this->once())
            ->method('login')
            ->with(new Login($this->userKey))
            ->willReturn(new LoginResponse($this->sessionId));

        $this->assertSame($this->userKey, $this->api->getUserKey());
        $this->assertTrue($this->api->login());
        $this->assertSame($this->sessionId, $this->api->getSessionId());
    }

    public function testLogout()
    {
        $this->apiClient
            ->expects($this->once())
            ->method('logout')
            ->with(new Logout($this->sessionId))
            ->willReturn(new LogoutResponse(true));

        $this->api->setSessionId($this->sessionId);
        $this->assertTrue($this->api->logout());
    }

    public function testGetSessionStatus()
    {
        $this->apiClient
            ->expects($this->exactly(2))
            ->method('getValue')
            ->with(new GetValue('StatusSesji'), $this->sessionId)
            ->willReturn(new GetValueResponse('1'));

        $this->api->setSessionId($this->sessionId);
        $this->assertSame(1, $this->api->getSessionStatus());
        $this->assertTrue($this->api->isLogged());
    }

    /**
     * @expectedException \GusApi\Exception\InvalidUserKeyException
     */
    public function testInvalidLogin()
    {
        $this->apiClient
            ->expects($this->once())
            ->method('login')
            ->with(new Login($this->userKey))
            ->willReturn(new LoginResponse(''));

        $this->api->login();
    }
}
