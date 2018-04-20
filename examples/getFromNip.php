<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../vendor/autoload.php';
session_start();

use GusApi\GusApi;
use GusApi\RegonConstantsInterface;
use GusApi\Exception\InvalidUserKeyException;


$key = 'abcde12345abcde12345'; // <--- your user key / twój klucz użytkownika

$context = new \GusApi\Context\Context();
$soap = new \GusApi\Client\SoapClient(
    RegonConstantsInterface::BASE_WSDL_URL_TEST,
    [
        'soap_version' => SOAP_1_2,
        'trace' => true,
        'style' => SOAP_DOCUMENT,
        'stream_context' => $context->getContext(),
        'classmap' => [
            'ZalogujResponse' => \GusApi\Type\LoginResponse::class,
            'WylogujResponse' => \GusApi\Type\LogoutResponse::class,
            'GetValueResponse' => \GusApi\Type\GetValueResponse::class,
            'DaneSzukajResponse' => \GusApi\Type\SearchResponseRaw::class,
            'DanePobierzPelnyRaportResponse' => \GusApi\Type\GetFullReportResponseRaw::class
        ]
    ]
);
$client = new \GusApi\Client\GusApiClient($soap, RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST, $context);

var_dump($sid = $client->login(new \GusApi\Type\Login('abcde12345abcde12345'))->ZalogujResult);
var_dump($client->getValue(
    new \GusApi\Type\GetValue(RegonConstantsInterface::PARAM_STATUS_DATE_STATE), $sid
));

$params = new \GusApi\Type\SearchParameters();
$params->setNip('8951930748');
$search = new \GusApi\Type\SearchData($params);
var_dump($client->searchData($search, $sid));

$searchData = new \GusApi\Type\GetFullReport('02083251200000', 'PublDaneRaportTypJednostki');
var_dump($client->getFullReport($searchData, $sid));
exit();

$gus = new GusApi(
    $key,
    new \GusApi\Adapter\Soap\SoapAdapter(
        RegonConstantsInterface::BASE_WSDL_URL_TEST,
        RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST //<--- production server / serwer produkcyjny
    //for test serwer use RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST
    //w przypadku serwera testowego użyj: RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST
    )
);

if (isset($_GET['reset'])) {
    $_SESSION = [];
    $_SESSION['checked'] = false;
}

if ($gus->serviceStatus() === RegonConstantsInterface::SERVICE_AVAILABLE) {

    try {

        if (!isset($_SESSION['sid']) || !$gus->isLogged($_SESSION['sid'])) {
            $_SESSION['sid'] = $gus->login();
        }

        printNipForm();

        if (isset($_POST['nip'])) {

            $nip = $_POST['nip'];
            try {
                $gusReports = $gus->getByNip($_SESSION['sid'], $nip);
                var_dump($gusReports);
                $mapper = new \GusApi\ReportTypeMapper();

                foreach ($gusReports as $gusReport) {
                    $reportType = $mapper->getReportType($gusReport);

                    var_dump($gus->getFullReport(
                        $_SESSION['sid'],
                        $gusReport,
                        $reportType
                    ));

                    echo $gusReport->getName();
                }

            } catch (\GusApi\Exception\NotFoundException $e) {
                echo 'No data found <br>';
                echo 'For more information read server message belowe: <br>';
                echo $gus->getResultSearchMessage($_SESSION['sid']);

            }
        }

    } catch (InvalidUserKeyException $e) {
        echo 'Bad user key!';
    }

} else if ($gus->serviceStatus() === RegonConstantsInterface::SERVICE_UNAVAILABLE) {

    echo 'Server is unavailable now. Please try again later <br>';
    echo 'For more information read server message belowe: <br>';
    echo $gus->serviceMessage();

} else {

    echo 'Server technical break. Please try again later <br>';
    echo 'For more information read server message belowe: <br>';
    echo $gus->serviceMessage();

}

function printNipForm()
{
    echo '<form action="" method="POST">';
    echo '<input type="text" name="nip" >';
    echo '<input type="submit" value="check">';
    echo '</form>';
}