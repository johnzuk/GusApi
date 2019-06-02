<?php

namespace GusApi;

final class ReportTypes
{
    public const REPORT_ACTIVITY_PHYSIC_PERSON = 'BIR11OsFizycznaDaneOgolne';
    public const REPORT_ACTIVITY_PHYSIC_CEIDG = 'BIR11OsFizycznaDzialalnoscCeidg';
    public const REPORT_ACTIVITY_PHYSIC_AGRO = 'BIR11OsFizycznaDzialalnoscRolnicza';
    public const REPORT_ACTIVITY_PHYSIC_OTHER_PUBLIC = 'BIR11OsFizycznaDzialalnoscPozostala';
    public const REPORT_ACTIVITY_LOCAL_PHYSIC_WKR_PUBLIC = 'BIR11OsFizycznaDzialalnoscSkreslonaDo20141108';
    public const REPORT_LOCALS_PHYSIC_PUBLIC = 'BIR11OsFizycznaPkd';
    public const REPORT_LOCAL_PHYSIC_PUBLIC = 'BIR11OsFizycznaListaJednLokalnych';
    public const REPORT_ACTIVITY_PHYSIC_PUBLIC = 'BIR11JednLokalnaOsFizycznej';
    public const REPORT_ACTIVITY_LOCAL_PHYSIC_PUBLIC = 'BIR11JednLokalnaOsFizycznejPkd';
    public const REPORT_PUBLIC_LAW = 'BIR11OsPrawna';
    public const REPORT_ACTIVITY_LAW_PUBLIC = 'BIR11OsPrawnaPkd';
    public const REPORT_LOCALS_LAW_PUBLIC = 'BIR11OsPrawnaListaJednLokalnych';
    public const REPORT_LOCAL_LAW_PUBLIC = 'BIR11JednLokalnaOsPrawnej';
    public const REPORT_ACTIVITY_LOCAL_LAW_PUBLIC = 'BIR11JednLokalnaOsPrawnejPkd';
    public const REPORT_COMMON_LAW_PUBLIC = 'BIR11OsPrawnaSpCywilnaWspolnicy';
    public const REPORT_UNIT_TYPE_PUBLIC = 'BIR11TypPodmiotu';

    public const REPORTS = [
        self::REPORT_ACTIVITY_PHYSIC_PERSON,
        self::REPORT_ACTIVITY_PHYSIC_CEIDG,
        self::REPORT_ACTIVITY_PHYSIC_AGRO,
        self::REPORT_ACTIVITY_PHYSIC_OTHER_PUBLIC,
        self::REPORT_ACTIVITY_LOCAL_PHYSIC_WKR_PUBLIC,
        self::REPORT_LOCALS_PHYSIC_PUBLIC,
        self::REPORT_LOCAL_PHYSIC_PUBLIC,
        self::REPORT_ACTIVITY_PHYSIC_PUBLIC,
        self::REPORT_ACTIVITY_LOCAL_PHYSIC_PUBLIC,
        self::REPORT_PUBLIC_LAW,
        self::REPORT_ACTIVITY_LAW_PUBLIC,
        self::REPORT_LOCALS_LAW_PUBLIC,
        self::REPORT_LOCAL_LAW_PUBLIC,
        self::REPORT_ACTIVITY_LOCAL_LAW_PUBLIC,
        self::REPORT_COMMON_LAW_PUBLIC,
        self::REPORT_UNIT_TYPE_PUBLIC,
    ];

    public const REGON_9_REPORTS = [
        self::REPORT_ACTIVITY_PHYSIC_PERSON,
        self::REPORT_ACTIVITY_PHYSIC_CEIDG,
        self::REPORT_ACTIVITY_PHYSIC_AGRO,
        self::REPORT_ACTIVITY_PHYSIC_OTHER_PUBLIC,
        self::REPORT_ACTIVITY_LOCAL_PHYSIC_WKR_PUBLIC,
        self::REPORT_LOCALS_PHYSIC_PUBLIC,
        self::REPORT_LOCAL_PHYSIC_PUBLIC,
        self::REPORT_PUBLIC_LAW,
        self::REPORT_ACTIVITY_LAW_PUBLIC,
        self::REPORT_LOCALS_LAW_PUBLIC,
        self::REPORT_COMMON_LAW_PUBLIC,
    ];
}
