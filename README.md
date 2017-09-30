PHP GUS API library
===================
PHP GUS API library based on **official** REGON SOAP api.
Official GUS docs [here](http://bip.stat.gov.pl/dzialalnosc-statystyki-publicznej/rejestr-regon/interfejsyapi/jak-skorzystac-informacja-dla-podmiotow-komercyjnych/)

Example
======================

```php
require_once '../vendor/autoload.php';

use GusApi\GusApi;
use GusApi\RegonConstantsInterface;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\ReportTypes;
use GusApi\ReportTypeMapper;

$gus = new GusApi(
    'abcde12345abcde12345', // <--- your user key / twój klucz użytkownika
    new \GusApi\Adapter\Soap\SoapAdapter(
        RegonConstantsInterface::BASE_WSDL_URL,
        RegonConstantsInterface::BASE_WSDL_ADDRESS //<--- production server / serwer produkcyjny
        //for test serwer use RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST
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
    echo 'For more information read server message belowe: <br>';
    echo $gus->getResultSearchMessage($sessionId);
}

```
or see file: getFromNip.php in examples directory.

PHP GUS API is an object-oriented library to get information from [Regon site](https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc)

