<?php

namespace Gus\GusApi\GusApi;

use Curl\Curl;
use Gus\GusApi\Exception\InvalidUserKeyException;

/**
 * Class GusApi
 * @package GusApi
 * @author Janusz Żukowicz <john_zuk@wp.pl>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
class GusApi
{

    private $sid = null;

    private $loginData = ["pKluczUzytkownika" => "aaaaaabbbbbcccccdddd"];

    /**
     * @var string
     */
    private $captchaFileName = "captcha.jpeg";

    private $loginUrl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/Zaloguj';

    public function __construct()
    {
    }

    public function login()
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');

        $curl->post($this->loginUrl, json_encode($this->loginData));

        if(empty($curl->response->d)){
            throw new InvalidUserKeyException("Invalid user key!");
        }

        $this->sid = $curl->response->d;

        $curl->close();
    }
}