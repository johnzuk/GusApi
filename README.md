PHP GUS API library
===================

PHP GUS API is an object-oriented library to get information from [REGON site](https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc) based on **official** REGON SOAP API.
Official GUS docs [here](http://bip.stat.gov.pl/dzialalnosc-statystyki-publicznej/rejestr-regon/interfejsyapi/jak-skorzystac-informacja-dla-podmiotow-komercyjnych/).

Installation
======================
This library uses [Composer](https://packagist.org/packages/gusapi/gusapi), just type in:
```composer require gusapi/gusapi```

Example
======================
See file [examples/getFromNip.php](examples/getFromNip.php).

```php
require_once '../vendor/autoload.php';

use GusApi\GusApi;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\ReportTypes;

$gus = new GusApi('your api key here');

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


