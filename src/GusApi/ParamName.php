<?php

declare(strict_types=1);

namespace GusApi;

interface ParamName
{
    public const USER_KEY = 'pKluczUzytkownika';
    public const SESSION_ID = 'pIdentyfikatorSesji';
    public const SEARCH = 'pParametryWyszukiwania';
    public const REGON = 'pRegon';
    public const REPORT_NAME = 'pNazwaRaportu';
    public const REPORT_DATE = 'pDataRaportu';
    public const PARAM_NAME = 'pNazwaParametru';

    public const STATUS_DATE_STATE = 'StanDanych';
    public const MESSAGE_CODE = 'KomunikatKod';
    public const MESSAGE = 'KomunikatTresc';
    public const SESSION_STATUS = 'StatusSesji';
    public const SERVICE_STATUS = 'StatusUslugi';
    public const SERVICE_MESSAGE = 'KomunikatUslugi';
}
