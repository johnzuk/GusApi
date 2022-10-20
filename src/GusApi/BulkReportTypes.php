<?php

declare(strict_types=1);

namespace GusApi;

final class BulkReportTypes
{
    public const REPORT_NEW_LEGAL_ENTITY_AND_NATURAL_PERSON = 'BIR11NowePodmiotyPrawneOrazDzialalnosciOsFizycznych';
    public const REPORT_UPDATED_LEGAL_ENTITY_AND_NATURAL_PERSON = 'BIR11AktualizowanePodmiotyPrawneOrazDzialalnosciOsFizycznych';
    public const REPORT_DELETED_LEGAL_ENTITY_AND_NATURAL_PERSON = 'BIR11SkreslonePodmiotyPrawneOrazDzialalnosciOsFizycznych';
    public const REPORT_NEW_LOCAL_UNITS = 'BIR11NoweJednostkiLokalne';
    public const REPORT_UPDATED_LOCAL_UNITS = 'BIR11AktualizowaneJednostkiLokalne';
    public const REPORT_DELETED_LOCAL_UNITS = 'BIR11SkresloneJednostkiLokalne';

    public const REPORTS = [
        self::REPORT_NEW_LEGAL_ENTITY_AND_NATURAL_PERSON,
        self::REPORT_UPDATED_LEGAL_ENTITY_AND_NATURAL_PERSON,
        self::REPORT_DELETED_LEGAL_ENTITY_AND_NATURAL_PERSON,
        self::REPORT_NEW_LOCAL_UNITS,
        self::REPORT_UPDATED_LOCAL_UNITS,
        self::REPORT_DELETED_LOCAL_UNITS,
    ];
}
