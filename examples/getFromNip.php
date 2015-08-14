<?php

require_once '../vendor/autoload.php';

use GusApi\GusApi;
use GusApi\Exception\InvalidUserKeyException;

session_start();

$gus = new GusApi("aaaaaabbbbbcccccdddd");

if (isset($_GET['reset'])) {
    $_SESSION = [];
    $_SESSION['checked'] = false;
}

if (!isset($_SESSION['sid'])) {
    try {
        $_SESSION['sid'] = $gus->login();
    } catch (InvalidUserKeyException $e) {
        echo $e->getMessage();
    }

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

    echo '<img src="captcha.jpeg?'.time().'">';
    echo '<form action="" method="POST">';
    echo '<input type="text" name="captcha" >';
    echo '<input type="submit" value="check">';
    echo '</form>';

} else {
    echo '<form action="" method="POST">';
    echo '<input type="text" name="nip" >';
    echo '<input type="submit" value="check">';
    echo '</form>';
}

if (isset($_POST['nip'])) {
    //$nip = '5250010976';
    //$nip = '9372557086';
    $nip = $_POST['nip'];

    try {
        $gusReport = $gus->getByNip($_SESSION['sid'], $nip);
        var_dump($gus->getFullReport($_SESSION['sid'], $gusReport));
        var_dump($gusReport);

    } catch (\GusApi\Exception\NotFoundException $e) {
        echo 'Brak danych';
    }



    //DaneRaportPrawnaPubl
    //

    //var_dump($gus->getFullData($_SESSION['sid'], $gusReport->getRegon(), ReportType::BASIC));
}
