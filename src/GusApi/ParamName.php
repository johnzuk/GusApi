<?php

namespace GusApi;

interface ParamName
{
    const USER_KEY = 'pKluczUzytkownika';
    const SESSION_ID = 'pIdentyfikatorSesji';
    const CAPTCHA = 'pCaptcha';
    const SEARCH = 'pParametryWyszukiwania';
    const REGON = 'pRegon';
    const REPORT_NAME = 'pNazwaRaportu';
    const PARAM_NAME = 'pNazwaParametru';

    const STATUS_DATE_STATE = 'StanDanych';
    const MESSAGE_CODE = 'KomunikatKod';
    const MESSAGE = 'KomunikatTresc';
    const SESSION_STATUS = 'StatusSesji';
    const SERVICE_STATUS = 'StatusUslugi';
    const SERVICE_MESSAGE = 'KomunikatUslugi';
}
