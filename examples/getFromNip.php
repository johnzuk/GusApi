<?php
error_reporting(E_ALL);
require_once '../vendor/autoload.php';
session_start();

use GusApi\GusApi;
use GusApi\RegonConstantsInterface;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\ReportTypes;


$key = ''; // <--- your user key / twój klucz użytkownika

$gus = new GusApi(
    $key,
    new \GusApi\Adapter\Soap\SoapAdapter(
        RegonConstantsInterface::BASE_WSDL_URL,
        RegonConstantsInterface::BASE_WSDL_ADDRESS //<--- production server / serwer produkcyjny
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
            $_SESSION['checked'] = false;
        }

        if (isset($_POST['captcha'])) {
            $_SESSION['checked'] = $gus->checkCaptcha($_SESSION['sid'], $_POST['captcha']);
        }

        if (!$_SESSION['checked']) {
            $image = fopen("captcha.jpeg",'w+');
            $captcha = $gus->getCaptcha($_SESSION['sid']);
            fwrite($image, base64_decode($captcha));
            fclose($image);

            printCaptchaForm();

        } else {
            printNipForm();
        }

        if (isset($_POST['nip'])) {

            $nip = $_POST['nip'];
            try {
                $gusReport = $gus->getByNip($_SESSION['sid'], $nip);
                var_dump($gusReport);
                var_dump(
                    $gus->getFullReport(
                        $_SESSION['sid'],
                        $gusReport,
                        ReportTypes::REPORT_ACTIVITY_LAW_PUBLIC
                    )
                );
                echo $gusReport->getName();

            } catch (\GusApi\Exception\NotFoundException $e) {
                echo 'No data found <br>';
                echo 'For more information read server message belowe: <br>';
                echo $gus->getResultSearchMessage();
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

function printCaptchaForm()
{
    echo '<img src="captcha.jpeg?'.time().'">';
    echo '<form action="" method="POST">';
    echo '<input type="text" name="captcha" >';
    echo '<input type="submit" value="check">';
    echo '</form>';
}

function printNipForm()
{
    echo '<form action="" method="POST">';
    echo '<input type="text" name="nip" >';
    echo '<input type="submit" value="check">';
    echo '</form>';
}