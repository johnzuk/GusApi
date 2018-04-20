<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 20.04.18
 * Time: 13:56
 */

namespace GusApi\Client;

use PHPUnit\Framework\TestCase;

class SoapActionMapperTest extends TestCase
{
    /**
     * @dataProvider actionProvider
     */
    public function testGetActionWithValidName($expected, $functionName)
    {
        $action = SoapActionMapper::getAction($functionName);
        $this->assertSame($expected, $action);
    }

    /**
     * @expectedException GusApi\Exception\InvalidActionNameException
     */
    public function testGetActionWithInvalidName()
    {
        SoapActionMapper::getAction('BadFunctionName');
    }

    public function actionProvider()
    {
        return [
            [
                'http://CIS/BIR/2014/07/IUslugaBIR/PobierzCaptcha', 'PobierzCaptcha'
            ],
            [
                'http://CIS/BIR/2014/07/IUslugaBIR/SprawdzCaptcha', 'SprawdzCaptcha'
            ],
            [
                'http://CIS/BIR/2014/07/IUslugaBIR/GetValue', 'GetValue'
            ],
            [
                'http://CIS/BIR/2014/07/IUslugaBIR/SetValue', 'SetValue'
            ],
            [
                'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/Zaloguj', 'Zaloguj'
            ],
            [
                'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/Wyloguj', 'Wyloguj'
            ],
            [
                'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DaneSzukaj', 'DaneSzukaj'
            ],
            [
                'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DanePobierzPelnyRaport', 'DanePobierzPelnyRaport'
            ],
            [
                'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/DaneKomunikat', 'DaneKomunikat'
            ],
        ];
    }
}
