<?php
namespace GusApi\Client;

use GusApi\Exception\InvalidActionNameException;

/**
 * Class SoapActionMapper
 * @package GusApi\Client
 */
class SoapActionMapper
{
    public const PUBLIC_NAMESPACE = 'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/';
    public const NAMESPACE = 'http://CIS/BIR/2014/07/IUslugaBIR/';

    public const ACTIONS = [
        'PobierzCaptcha' => self::NAMESPACE,
        'SprawdzCaptcha' => self::NAMESPACE,
        'GetValue' => self::NAMESPACE,
        'SetValue' => self::NAMESPACE,
        'Zaloguj' => self::PUBLIC_NAMESPACE,
        'Wyloguj' => self::PUBLIC_NAMESPACE,
        'DaneSzukaj' => self::PUBLIC_NAMESPACE,
        'DanePobierzPelnyRaport' => self::PUBLIC_NAMESPACE,
        'DaneKomunikat' => self::PUBLIC_NAMESPACE,
    ];

    /**
     * @param string $functionName
     * @return string
     * @throws InvalidActionNameException
     */
    public static function getAction(string $functionName): string
    {
        if (!isset(self::ACTIONS[$functionName])) {
            throw new InvalidActionNameException(sprintf('Invalid action %s', $functionName));
        }

        return self::ACTIONS[$functionName].$functionName;
    }
}
