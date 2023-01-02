# UPGRADE FROM 5.x to 6.0

Installation
------------
Before upgrading this package make sure you are using [PHP 8.0](http://php.net/migration80) or newer as it is required to run version 5.0 of this library.

To upgrade, simply run:
```bash
composer require gusapi/gusapi ^6.0
``` 

Everything should work the same as in versions 5.x - 

GusApi
-------
* The `GusApi::getUserKey` has been removed.

* The `GusApi::setUserKey` has been removed.

* The `GusApi::getResultSearchMessage` has been removed.

ReportTypes
-----
* Const `ReportTypes::REPORT_ACTIVITY_PHYSIC_PERSON` has been removed and replaced by `ReportTypes::REPORT_PERSON`.
* Const `ReportTypes::REPORT_ACTIVITY_PHYSIC_CEIDG` has been removed and replaced by `ReportTypes::REPORT_PERSON_CEIDG`.
* Const `ReportTypes::REPORT_ACTIVITY_PHYSIC_AGRO` has been removed and replaced by `ReportTypes::REPORT_PERSON_AGRO`.
* Const `ReportTypes::REPORT_ACTIVITY_PHYSIC_OTHER_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_PERSON_OTHER`.
* Const `ReportTypes::REPORT_ACTIVITY_LOCAL_PHYSIC_WKR_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_PERSON_DELETED_BEFORE_20141108`.
* Const `ReportTypes::REPORT_LOCALS_PHYSIC_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_PERSON_LOCALS`.
* Const `ReportTypes::REPORT_LOCAL_PHYSIC_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_PERSON_LOCAL`.
* Const `ReportTypes::REPORT_ACTIVITY_PHYSIC_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_PERSON_ACTIVITY`.
* Const `ReportTypes::REPORT_ACTIVITY_LOCAL_PHYSIC_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_PERSON_LOCAL_ACTIVITY`.
* Const `ReportTypes::REPORT_PUBLIC_LAW` has been removed and replaced by `ReportTypes::REPORT_ORGANIZATION`.
* Const `ReportTypes::REPORT_ACTIVITY_LAW_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_ORGANIZATION_ACTIVITY`.
* Const `ReportTypes::REPORT_LOCALS_LAW_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_ORGANIZATION_LOCALS`.
* Const `ReportTypes::REPORT_LOCAL_LAW_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_ORGANIZATION_LOCAL`.
* Const `ReportTypes::REPORT_ACTIVITY_LOCAL_LAW_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_ORGANIZATION_LOCAL_ACTIVITY`.
* Const `ReportTypes::REPORT_COMMON_LAW_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_ORGANIZATION_PARTNERS`.
* Const `ReportTypes::REPORT_UNIT_TYPE_PUBLIC` has been removed and replaced by `ReportTypes::REPORT_UNIT_TYPE`.
