<?php

declare(strict_types=1);

namespace GusApi;

final class ReportTypes
{
    public const REPORT_PERSON = 'BIR11OsFizycznaDaneOgolne';
    public const REPORT_PERSON_CEIDG = 'BIR11OsFizycznaDzialalnoscCeidg';
    public const REPORT_PERSON_AGRO = 'BIR11OsFizycznaDzialalnoscRolnicza';
    public const REPORT_PERSON_OTHER = 'BIR11OsFizycznaDzialalnoscPozostala';
    public const REPORT_PERSON_DELETED_BEFORE_20141108 = 'BIR11OsFizycznaDzialalnoscSkreslonaDo20141108';
    public const REPORT_PERSON_LOCALS = 'BIR11OsFizycznaListaJednLokalnych';
    public const REPORT_PERSON_LOCAL = 'BIR11JednLokalnaOsFizycznej';
    public const REPORT_PERSON_ACTIVITY = 'BIR11OsFizycznaPkd';
    public const REPORT_PERSON_LOCAL_ACTIVITY = 'BIR11JednLokalnaOsFizycznejPkd';
    public const REPORT_ORGANIZATION = 'BIR11OsPrawna';
    public const REPORT_ORGANIZATION_ACTIVITY = 'BIR11OsPrawnaPkd';
    public const REPORT_ORGANIZATION_LOCALS = 'BIR11OsPrawnaListaJednLokalnych';
    public const REPORT_ORGANIZATION_LOCAL = 'BIR11JednLokalnaOsPrawnej';
    public const REPORT_ORGANIZATION_LOCAL_ACTIVITY = 'BIR11JednLokalnaOsPrawnejPkd';
    public const REPORT_ORGANIZATION_PARTNERS = 'BIR11OsPrawnaSpCywilnaWspolnicy';
    public const REPORT_UNIT_TYPE = 'BIR11TypPodmiotu';

    public const REPORTS = [
        self::REPORT_PERSON,
        self::REPORT_PERSON_CEIDG,
        self::REPORT_PERSON_AGRO,
        self::REPORT_PERSON_OTHER,
        self::REPORT_PERSON_DELETED_BEFORE_20141108,
        self::REPORT_PERSON_LOCALS,
        self::REPORT_PERSON_LOCAL,
        self::REPORT_PERSON_ACTIVITY,
        self::REPORT_PERSON_LOCAL_ACTIVITY,
        self::REPORT_ORGANIZATION,
        self::REPORT_ORGANIZATION_ACTIVITY,
        self::REPORT_ORGANIZATION_LOCALS,
        self::REPORT_ORGANIZATION_LOCAL,
        self::REPORT_ORGANIZATION_LOCAL_ACTIVITY,
        self::REPORT_ORGANIZATION_PARTNERS,
        self::REPORT_UNIT_TYPE,
    ];

    public const REGON_9_REPORTS = [
        self::REPORT_PERSON,
        self::REPORT_PERSON_CEIDG,
        self::REPORT_PERSON_AGRO,
        self::REPORT_PERSON_OTHER,
        self::REPORT_PERSON_DELETED_BEFORE_20141108,
        self::REPORT_PERSON_LOCALS,
        self::REPORT_PERSON_ACTIVITY,
        self::REPORT_PERSON_LOCAL,
        self::REPORT_ORGANIZATION,
        self::REPORT_ORGANIZATION_ACTIVITY,
        self::REPORT_ORGANIZATION_LOCALS,
        self::REPORT_ORGANIZATION_PARTNERS,
    ];
}
