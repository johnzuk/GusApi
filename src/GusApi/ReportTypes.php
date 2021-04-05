<?php

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

    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_PERSON" instead */
    public const REPORT_ACTIVITY_PHYSIC_PERSON = self::REPORT_PERSON;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_PERSON_CEIDG" instead */
    public const REPORT_ACTIVITY_PHYSIC_CEIDG = self::REPORT_PERSON_CEIDG;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_PERSON_AGRO" instead */
    public const REPORT_ACTIVITY_PHYSIC_AGRO = self::REPORT_PERSON_AGRO;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_PERSON_OTHER" instead */
    public const REPORT_ACTIVITY_PHYSIC_OTHER_PUBLIC = self::REPORT_PERSON_OTHER;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_PERSON_DELETED_BEFORE_20141108" instead */
    public const REPORT_ACTIVITY_LOCAL_PHYSIC_WKR_PUBLIC = self::REPORT_PERSON_DELETED_BEFORE_20141108;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_PERSON_LOCALS" instead */
    public const REPORT_LOCALS_PHYSIC_PUBLIC = self::REPORT_PERSON_LOCALS;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_PERSON_LOCAL" instead */
    public const REPORT_LOCAL_PHYSIC_PUBLIC = self::REPORT_PERSON_LOCAL;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_PERSON_ACTIVITY" instead */
    public const REPORT_ACTIVITY_PHYSIC_PUBLIC = self::REPORT_PERSON_ACTIVITY;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_PERSON_LOCAL_ACTIVITY" instead */
    public const REPORT_ACTIVITY_LOCAL_PHYSIC_PUBLIC = self::REPORT_PERSON_LOCAL_ACTIVITY;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_ORGANIZATION" instead */
    public const REPORT_PUBLIC_LAW = self::REPORT_ORGANIZATION;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_ORGANIZATION_ACTIVITY" instead */
    public const REPORT_ACTIVITY_LAW_PUBLIC = self::REPORT_ORGANIZATION_ACTIVITY;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_ORGANIZATION_LOCALS" instead */
    public const REPORT_LOCALS_LAW_PUBLIC = self::REPORT_ORGANIZATION_LOCALS;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_ORGANIZATION_LOCAL" instead */
    public const REPORT_LOCAL_LAW_PUBLIC = self::REPORT_ORGANIZATION_LOCAL;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_ORGANIZATION_LOCAL_ACTIVITY" instead */
    public const REPORT_ACTIVITY_LOCAL_LAW_PUBLIC = self::REPORT_ORGANIZATION_LOCAL_ACTIVITY;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_ORGANIZATION_PARTNERS" instead */
    public const REPORT_COMMON_LAW_PUBLIC = self::REPORT_ORGANIZATION_PARTNERS;
    /** @deprecated deprecated since version 5.3 and will be removed in 6.0, use "REPORT_UNIT_TYPE" instead */
    public const REPORT_UNIT_TYPE_PUBLIC = self::REPORT_UNIT_TYPE;

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
        self::REPORT_PERSON_LOCAL,
        self::REPORT_ORGANIZATION,
        self::REPORT_ORGANIZATION_ACTIVITY,
        self::REPORT_ORGANIZATION_LOCALS,
        self::REPORT_ORGANIZATION_PARTNERS,
    ];
}
