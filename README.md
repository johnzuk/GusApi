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
| Version | PHP version | BIR service version                   | Support                          | Doc  |
|---------|-------------|---------------------------------------|----------------------------------|------|
| 6.x     | >= 8.0      | BIR1.1 (available since October 2022) | Support ends on April 1, 2023    | [Doc](https://github.com/johnzuk/GusApi/blob/master/README.md)|
| 5.x     | >= 7.1      | BIR1.1 (available since May 2019)     | Support ends on December 1, 2020 | [Doc](https://github.com/johnzuk/GusApi/blob/5.0.0/README.md)|

If you still use PHP <= 8.0 see documentation for 5.x version [HERE](https://github.com/johnzuk/GusApi/blob/5.0.0/README.md)
-------------------
Upgrade from 5.x to 6.x
=========================
For more information see [UPGRADE.md](UPGRADE.md).


Example for 6.x
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
        BulkReportTypes::REPORT_DELETED_LOCAL_UNITS
    ));

    foreach ($gusReports as $gusReport) {
        //you can change report type to other one
        $reportType = ReportTypes::REPORT_PERSON;
        echo $gusReport->getName();
        echo 'Address: ' . $gusReport->getStreet() . ' ' . $gusReport->getPropertyNumber() . '/' . $gusReport->getApartmentNumber();

        $fullReport = $gus->getFullReport($gusReport, $reportType);
        var_dump($fullReport);
    }
} catch (InvalidUserKeyException $e) {
    echo 'Bad user key';
} catch (NotFoundException $e) {
    echo 'No data found <br>';
    echo 'For more information read server message below: <br>';
    echo sprintf(
        "StatusSesji:%s\nKomunikatKod:%s\nKomunikatTresc:%s\n",
        $gus->getSessionStatus(),
        $gus->getMessageCode(),
        $gus->getMessage()
    );
}

```

Donation
======================
If this project help you reduce time to develop, you can give me a cup of coffee ;)  
[PayPal Donate](https://www.paypal.me/johnzuk)
