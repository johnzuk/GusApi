<?php

declare(strict_types=1);

namespace GusApi\Client;

use GusApi\Exception\InvalidActionNameException;

class SoapActionMapper
{
    public const PUBLIC_NAMESPACE = 'http://CIS/BIR/PUBL/2014/07/IUslugaBIRzewnPubl/';
    public const NAMESPACE = 'http://CIS/BIR/2014/07/IUslugaBIR/';

    public const ACTIONS = [
        'GetValue' => self::NAMESPACE,
        'Zaloguj' => self::PUBLIC_NAMESPACE,
        'Wyloguj' => self::PUBLIC_NAMESPACE,
        'DaneSzukajPodmioty' => self::PUBLIC_NAMESPACE,
        'DanePobierzPelnyRaport' => self::PUBLIC_NAMESPACE,
        'DanePobierzRaportZbiorczy' => self::PUBLIC_NAMESPACE,
    ];

    /**
     * @throws InvalidActionNameException
     */
    public static function getAction(string $functionName): string
    {
        if (!isset(self::ACTIONS[$functionName])) {
            throw new InvalidActionNameException(sprintf('Invalid action %s', $functionName));
        }

        return self::ACTIONS[$functionName] . $functionName;
    }
}
