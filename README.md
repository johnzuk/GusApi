PHP GUS API library
===================
[![Packagist](https://img.shields.io/packagist/l/gusapi/gusapi.svg)](https://packagist.org/packages/gusapi/gusapi)
[![Build Status](https://travis-ci.org/johnzuk/GusApi.svg?branch=master)](https://travis-ci.org/johnzuk/GusApi)
[![Packagist](https://img.shields.io/packagist/v/gusapi/gusapi.svg)](https://packagist.org/packages/gusapi/gusapi)
[![Packagist](https://img.shields.io/packagist/dt/gusapi/gusapi.svg)](https://packagist.org/packages/gusapi/gusapi)
[![StyleCI](https://styleci.io/repos/30836493/shield?branch=master)](https://styleci.io/repos/30836493)

PHP GUS API is an object-oriented library to get information from [REGON site](https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc) based on **official** REGON SOAP API.
Official GUS docs [here](http://bip.stat.gov.pl/dzialalnosc-statystyki-publicznej/rejestr-regon/interfejsyapi/jak-skorzystac-informacja-dla-podmiotow-komercyjnych/).

Installation
======================
This library uses [Composer](https://packagist.org/packages/gusapi/gusapi), just type in:
```bash
composer require gusapi/gusapi
```

Supported Versions
==================
|Version|PHP version |Support                           | Doc  |
|-------|------------|----------------------------------|------|
|4.x    | >= 7.1     | Support ends on December 1, 2019 | [Doc](https://github.com/johnzuk/GusApi/blob/master/README.md)|
|3.3.x  | >= 5.6     | Support ends on December 1, 2018 | [Doc](https://github.com/johnzuk/GusApi/blob/3.3/README.md) |
|3.2.x  | >= 5.4     | Support ended on April 1, 2018   | [Doc](https://github.com/johnzuk/GusApi/blob/3.2/README.md) |

####If you use PHP <= 7.0 see documentation for 3.3.x version [HERE](https://github.com/johnzuk/GusApi/blob/master/README.md)

Upgrade from 3.x to 4.x
=========================
For more information see [UPGRADE.md](UPGRADE.md).


Example for 4.x
======================
See file [examples/readmeExample.php](examples/readmeExample.php).

```php
require_once '../vendor/autoload.php';

use GusApi\Exception\InvalidUserKeyException;
use GusApi\GusApi;
use GusApi\ReportTypes;

$gus = new GusApi('your api key here');
//for development server use:
//$gus = new GusApi('abcde12345abcde12345', 'dev');

try {
    $nipToCheck = 'xxxxxxxxxx'; //change to valid nip value
    $gus->login();

    $gusReports = $gus->getByNip($nipToCheck);

    foreach ($gusReports as $gusReport) {
        //you can change report type to other one
        $reportType = ReportTypes::REPORT_PUBLIC_LAW;
        echo $gusReport->getName();
        $fullReport = $gus->getFullReport($gusReport, $reportType);
        var_dump($fullReport);
    }
} catch (InvalidUserKeyException $e) {
    echo 'Bad user key';
} catch (\GusApi\Exception\NotFoundException $e) {
    echo 'No data found <br>';
    echo 'For more information read server message below: <br>';
    echo $gus->getResultSearchMessage();
}

```


