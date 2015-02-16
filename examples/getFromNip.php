<?php

require_once '../vendor/autoload.php';

use Gus\GusApi\GusApi\GusApi;

session_start();

if(!isset($_SESSION['gus']) || isset($_GET['reset']))
{
    $_SESSION['gus'] = new GusApi();
    $gus = &$_SESSION['gus'];
}

$gus = &$_SESSION['gus'];


if(!($gus->getCaptchaStatus()) && $gus == null)
{
    $gus->getCaptcha();
}

if($gus->getCaptchaStatus() || isset($_POST['captcha']))
{
    if($gus->getCaptchaStatus() || $gus->checkCaptcha($_POST['captcha']))
    {
        var_dump($gus->getInfoByNip("5250010976"));
        var_dump($gus->getInfoByRegon("010344708"));
    }
}

echo '<img src="captcha.jpeg">';
echo '<form action="" method="POST">';
echo '<input type="text" name="captcha" >';
echo '<input type="submit" value="check">';
echo '</form>';
