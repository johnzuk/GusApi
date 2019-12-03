PHP GUS API library
===================
[![Packagist](https://img.shields.io/packagist/l/gusapi/gusapi.svg)](https://packagist.org/packages/gusapi/gusapi)
[![Build Status](https://travis-ci.org/johnzuk/GusApi.svg?branch=master)](https://travis-ci.org/johnzuk/GusApi)
[![Codecov](https://img.shields.io/codecov/c/github/johnzuk/GusApi/master.svg)](https://codecov.io/gh/johnzuk/GusApi)
[![Packagist](https://img.shields.io/packagist/v/gusapi/gusapi.svg)](https://packagist.org/packages/gusapi/gusapi)
[![Packagist](https://img.shields.io/packagist/dt/gusapi/gusapi.svg)](https://packagist.org/packages/gusapi/gusapi)
[![StyleCI](https://styleci.io/repos/30836493/shield?branch=master)](https://styleci.io/repos/30836493)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/johnzuk/GusApi/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/johnzuk/GusApi/?branch=master)

PHP GUS API is an object-oriented library to get information from [REGON site](https://api.stat.gov.pl/Home/RegonApi) based on **official** REGON SOAP API.
Official GUS docs [here](https://api.stat.gov.pl/Home/RegonApi).

Installation
======================
This library uses [Composer](https://packagist.org/packages/gusapi/gusapi), just type in:
```bash
composer require gusapi/gusapi
```

Supported Versions
==================
|Version|PHP version | BIR service version | Support                           | Doc  |
|-------|------------|--------|----------------------------------|------|
|5.x    | >= 7.1     | BIR1.1 (available since May 2019) | Support ends on December 1, 2020 | [Doc](https://github.com/johnzuk/GusApi/blob/master/README.md)|
|4.x    | >= 7.1     | BIR1  | Support ends on December 1, 2019 | [Doc](https://github.com/johnzuk/GusApi/tree/4.0.2/README.md)|
|3.3.x  | >= 5.6     | BIR1  | Support ends on December 1, 2018 | [Doc](https://github.com/johnzuk/GusApi/blob/3.3/README.md) |
|3.2.x  | >= 5.4     | BIR1  | Support ended on April 1, 2018   | [Doc](https://github.com/johnzuk/GusApi/blob/3.2/README.md) |

If you still use PHP <= 7.0 see documentation for 3.3.x version [HERE](https://github.com/johnzuk/GusApi/blob/3.3/README.md)
-------------------
New in 5.x (this version support BIR1.1)
========================================
* New properties in `SearchReport`:
  * nip
  * nipStatus
  * propertyNumber
  * apartmentNumber
  * activityEndDate

    **Till version 5.x you dont need to get full report to find property number and apartment number**

* Method getFullReport throws `InvalidReportTypeException` for invalid report name
* Method dataStatus now return `DateTimeImmutable` instead of `DateTime` and throws `InvalidServerResponseException`
* New method getBulkReport - new search type in BIR1.1 (mode documentation [here](https://api.stat.gov.pl/Home/RegonApi)) 
  with `BulkReportTypes`
* New supported report types for `getBulkReport` method (based on BIR1.1 documentation):
    ```php
    public const REPORT_NEW_LEGAL_ENTITY_AND_NATURAL_PERSON = 'BIR11NowePodmiotyPrawneOrazDzialalnosciOsFizycznych';
    public const REPORT_UPDATED_LEGAL_ENTITY_AND_NATURAL_PERSON = 'BIR11AktualizowanePodmiotyPrawneOrazDzialalnosciOsFizycznych';
    public const REPORT_DELETED_LEGAL_ENTITY_AND_NATURAL_PERSON = 'BIR11SkreslonePodmiotyPrawneOrazDzialalnosciOsFizycznych';
    public const REPORT_NEW_LOCAL_UNITS = 'BIR11NoweJednostkiLokalne';
    public const REPORT_UPDATED_LOCAL_UNITS = 'BIR11AktualizowaneJednostkiLokalne';
    public const REPORT_DELETED_LOCAL_UNITS = 'BIR11SkresloneJednostkiLokalne';
    ```  
  
* Remove  `ReportTypeMapper`
 
Upgrade from 4.x to 5.x
=========================
For more information see [UPGRADE.md](UPGRADE.md).


Example for 5.x
======================
See file [examples/readmeExample.php](examples/readmeExample.php).

```php

require_once '../vendor/autoload.php';

use GusApi\Exception\InvalidUserKeyException;
use GusApi\Exception\NotFoundException;
use GusApi\GusApi;
use GusApi\ReportTypes;
use GusApi\BulkReportTypes;

$gus = new GusApi('your api key here');
//for development server use:
//$gus = new GusApi('abcde12345abcde12345', 'dev');

try {
    $nipToCheck = 'xxxxxxxxxx'; //change to valid nip value
    $gus->login();

    $gusReports = $gus->getByNip($nipToCheck);

    var_dump($gus->dataStatus());
    var_dump($gus->getBulkReport(
        new DateTimeImmutable('2019-05-31'),
        BulkReportTypes::REPORT_DELETED_LOCAL_UNITS));

    foreach ($gusReports as $gusReport) {
        //you can change report type to other one
        $reportType = ReportTypes::REPORT_ACTIVITY_PHYSIC_PERSON;
        echo $gusReport->getName();
        echo 'Address: '. $gusReport->getStreet(). ' ' . $gusReport->getPropertyNumber() . '/' . $gusReport->getApartmentNumber();
        
        $fullReport = $gus->getFullReport($gusReport, $reportType);
        var_dump($fullReport);
    }
} catch (InvalidUserKeyException $e) {
    echo 'Bad user key';
} catch (NotFoundException $e) {
    echo 'No data found <br>';
    echo 'For more information read server message below: <br>';
    echo $gus->getResultSearchMessage();
}

```

Donation
======================
If this project help you reduce time to develop, you can give me a cup of coffee ;)  
[PayPal Donate](https://www.paypal.me/johnzuk)
