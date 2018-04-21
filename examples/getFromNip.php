<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../vendor/autoload.php';
session_start();

use GusApi\Exception\InvalidUserKeyException;
use GusApi\GusApi;
use GusApi\RegonConstantsInterface;

//for development test use this:
$key = 'abcde12345abcde12345';
$gus = new GusApi($key, 'dev');

//for production use this:
//$key = 'your_api_key';
//$gus = new GusApi($key);

if (isset($_GET['reset'])) {
    $_SESSION = [];
    $_SESSION['checked'] = false;
}

if ($gus->serviceStatus() === RegonConstantsInterface::SERVICE_AVAILABLE) {
    try {
        if (!isset($_SESSION['sid']) || !$gus->isLogged()) {
            $_SESSION['sid'] = $gus->login();
        } else {
            $gus->setSessionId($_SESSION['id']);
        }

        printNipForm();

        if (isset($_POST['nip'])) {
            $nip = $_POST['nip'];

            try {
                $gusReports = $gus->getByNip($nip);
                var_dump($gusReports);
                $mapper = new \GusApi\ReportTypeMapper();

                foreach ($gusReports as $gusReport) {
                    $reportType = $mapper->getReportType($gusReport);

                    var_dump($gus->getFullReport(
                        $gusReport,
                        $reportType
                    ));

                    echo $gusReport->getName();
                }
            } catch (\GusApi\Exception\NotFoundException $e) {
                echo 'No data found <br>';
                echo 'For more information read server message belowe: <br>';
                echo $gus->getResultSearchMessage();
            }
        }
    } catch (InvalidUserKeyException $e) {
        echo 'Bad user key!';
    }
} elseif ($gus->serviceStatus() === RegonConstantsInterface::SERVICE_UNAVAILABLE) {
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
