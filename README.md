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
use GusApi\RegonConstantsInterface;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\ReportTypes;
use GusApi\ReportTypeMapper;

$gus = new GusApi(
    'abcde12345abcde12345', // your user key / twój klucz użytkownika
    new \GusApi\Adapter\Soap\SoapAdapter(
        RegonConstantsInterface::BASE_WSDL_URL,
        RegonConstantsInterface::BASE_WSDL_ADDRESS // production server / serwer produkcyjny
        //for test server use RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST
        //w przypadku serwera testowego użyj: RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST
    )
);

$mapper = new ReportTypeMapper();

try {
    $nipToCheck = 'xxxxxxxxxx'; //change to valid nip value
    $sessionId = $gus->login();
    
    $gusReports = $gus->getByNip($sessionId, $nipToCheck);
    
    foreach ($gusReports as $gusReport) {
        $reportType = $mapper->getReportType($gusReport);

        var_dump($gus->getFullReport(
            $sessionId,
            $gusReport,
            $reportType
        ));

        echo $gusReport->getName();
    }
    
} catch (InvalidUserKeyException $e) {
    echo 'Bad user key';
} catch (\GusApi\Exception\NotFoundException $e) {
    echo 'No data found <br>';
    echo 'For more information read server message below: <br>';
    echo $gus->getResultSearchMessage($sessionId);
}

```


