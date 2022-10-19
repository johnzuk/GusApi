<?php

declare(strict_types=1);

namespace GusApi\Tests\Client;

use GusApi\Client\SoapActionMapper;
use GusApi\Exception\InvalidActionNameException;
use PHPUnit\Framework\TestCase;

final class SoapActionMapperTest extends TestCase
{
    /**
     * @dataProvider actionProvider
     */
    public function testGetActionWithValidName(string $expected, string $functionName): void
    {
        $action = SoapActionMapper::getAction($functionName);
        $this->assertSame($expected, $action);
    }

    public function testGetActionWithInvalidName(): void
    {
        $this->expectException(InvalidActionNameException::class);
        SoapActionMapper::getAction('BadFunctionName');
    }

    public function actionProvider(): array
    {
        return [
            [
                'http://CIS/BIR/2014/07/IUslugaBIR/GetValue', 'GetValue',
            ],
            [
                'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/Zaloguj', 'Zaloguj',
            ],
            [
                'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/Wyloguj', 'Wyloguj',
            ],
            [
                'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DaneSzukajPodmioty', 'DaneSzukajPodmioty',
            ],
            [
                'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DanePobierzPelnyRaport', 'DanePobierzPelnyRaport',
            ],
            [
                'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DanePobierzRaportZbiorczy', 'DanePobierzRaportZbiorczy',
            ],
        ];
    }
}
