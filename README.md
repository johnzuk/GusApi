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

$gus = new GusApi(
    'abcde12345abcde12345', // <--- your user key / twój klucz użytkownika
    new \GusApi\Adapter\Soap\SoapAdapter(
        RegonConstantsInterface::BASE_WSDL_URL,
        RegonConstantsInterface::BASE_WSDL_ADDRESS //<--- production server / serwer produkcyjny
        //for test serwer use RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST
        //w przypadku serwera testowego użyj: RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST
    )
);

try {
    $gus->login();
} catch (InvalidUserKeyException $e) {
    echo 'Bad user key';
}

```
or see file: getFromNip.php in examples directory.

PHP GUS API is an object-oriented library to get information from [Regon site](https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc)

