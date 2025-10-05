<?php

declare(strict_types=1);

namespace GusApi\Tests\Client;

use GusApi\Client\SoapActionMapper;
use GusApi\Exception\InvalidActionNameException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class SoapActionMapperTest extends TestCase
{
    #[DataProvider('actionProvider')]
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

    /**
     * @return iterable<array{0: string, 1: string}>
     */
    public static function actionProvider(): iterable
    {
        yield ['http://CIS/BIR/2014/07/IUslugaBIR/GetValue', 'GetValue'];
        yield ['http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/Zaloguj', 'Zaloguj'];
        yield ['http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/Wyloguj', 'Wyloguj'];
        yield ['http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DaneSzukajPodmioty', 'DaneSzukajPodmioty'];
        yield ['http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DanePobierzPelnyRaport', 'DanePobierzPelnyRaport'];
        yield ['http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DanePobierzRaportZbiorczy', 'DanePobierzRaportZbiorczy'];
    }
}
