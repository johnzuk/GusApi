# UPGRADE FROM 4.x to 5.0

Installation
------------
Before upgrading this package make sure you are using [PHP 7.1](http://php.net/migration71) or newer as it is required to run version 5.0 of this library.

To upgrade, simply run:
```bash
composer require gusapi/gusapi ^5.0
``` 

Everything should work the same as in versions 4.x - 

GusApi
-------
* The `GusApi::getFullReport` now throws `InvalidReportTypeException` for invalid report name.

* The `getBulkReport` method added.

* The `GusApi::dataStatus` now returns `DateTimeImmutable` instead of `DateTime`.

* The `GusApi::dataStatus` now throws `InvalidServerResponseException` exception.

SearchReport
-----

* Property `SearchReport::$regon14` has been removed.

* The `SearchReport::$nip` `$nipStatus` `$propertyNumber` `$apartmentNumber` `$activityEndDate` properties have been added.

BulkReportTypes
------
* The `BulkReportTypes` has been added.

ReportTypeMapper
------
* The `ReportTypeMapper` has been removed.

Request
-----
* The `GetValue::setPNazwaParametru` method has been removed.

* The `GetFullReport::setPRegon` and `setPNazwaRaportu` methods have been removed.
