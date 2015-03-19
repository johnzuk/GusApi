<?php

namespace GusApi;

use Curl\Curl;
use GusApi\Exception\InvalidUserKeyException;

/**
 * Class GusApi
 * @package GusApi
 * @author Janusz Żukowicz <john_zuk@wp.pl>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
class GusApi
{

    const userKey = "aaaaaabbbbbcccccdddd";

     private $searchData = [
        'jestWojPowGmn' => true,
        'pParametryWyszukiwania' => [
            'AdsSymbolGminy' => null,
            'AdsSymbolMiejscowosci' => null,
            'AdsSymbolPowiatu' => null,
            'AdsSymbolUlicy' => null,
            'AdsSymbolWojewodztwa' => null,
            'Dzialalnosci' => null,
            'FormaPrawna' => null,
            'Krs' => null,
            'Krsy' => null,
            'NazwaPodmiotu' => null,
            'Nip' => null,
            'Nipy' => null,
            'NumerwRejestrzeLubEwidencji' => null,
            'OrganRejestrowy' => null,
            'PrzewazajacePKD' => false,
            'Regon' => null,
            'Regony14zn' => null,
            'Regony9zn' => null,
            'RodzajRejestru' => null
        ]
     ];

    private $responseType;

    private $loginUrl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/Zaloguj';

    private $getCaptchaUrl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/PobierzCaptcha';

    private $checkCaptchaUrl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/SprawdzCaptcha';

    private $searchDataUrl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/daneSzukaj';

    private $getComplexDataUrl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/DanePobierzPelnyRaport';

    public function __construct($assoc = false)
    {
        $this->responseType = $assoc;
    }

    /**
     * Login user to regon server
     *
     * @return string session id
     */
    public function login()
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');

        $curl->post($this->loginUrl, json_encode(["pKluczUzytkownika" => self::userKey]));

        if(empty($curl->response->d)){
            throw new InvalidUserKeyException("Invalid user key!");
        }

        $curl->close();

        return $curl->response->d;
    }

    /**
     * Return base64 encode value of captcha file
     *
     * @param string $sid session id
     * @return string base64 encode value of captcha file
     */
    public function getCaptcha($sid)
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('sid', $sid );
        $curl->post($this->getCaptchaUrl,'');

        $curl->close();

        return $curl->response->d;
    }

    /**
     * Check captcha value
     *
     * @param string $sid session id
     * @param string $captcha value
     * @return bool captcha status
     */
    public function checkCaptcha($sid, $captcha)
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('sid', $sid);
        $curl->post($this->checkCaptchaUrl, json_encode(array('pCaptcha'=>$captcha)));
        $curl->close();

        return (bool)$curl->response->d;
    }

    public function getInfoByNip($sid, $nip, $types = 'DaneRaportPrawnaPubl')
    {

        $info = $this->search($sid, [
            'pParametryWyszukiwania' => [
                'Nip' => $nip
            ]
        ]);

        return $this->getComplexData($sid, $info[0]->Regon, $types);
    }

    public function getInfoByRegon($sid, $regon, $types = 'DaneRaportPrawnaPubl')
    {
        $info = $this->search($sid, [
            'pParametryWyszukiwania' => [
                'Regon' => $regon
            ]
        ]);

        return $this->getComplexData($sid, $info[0]->Regon, $types);
    }

    public function getInfoByKrs($sid, $krs, $types = 'DaneRaportPrawnaPubl')
    {
        $info = $this->search($sid, [
            'pParametryWyszukiwania' => [
                'Krs' => $krs
            ]
        ]);

        return $this->getComplexData($sid, $info[0]->Regon, $types);
    }


    private function getComplexData($sid, $regon, $types)
    {
        $searchData = [
            'pNazwaRaportu'=>$types,
            'pRegon' => $regon,
            'pSilosID' => 0
        ];

        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('sid', $sid);
        $curl->post($this->getComplexDataUrl, json_encode($searchData));
        $curl->close();

        $response = json_decode($curl->response->d, $this->responseType);
        return $response[0];
    }

    private function search($sid, array $searchData)
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('sid', $sid);
        $curl->post($this->searchDataUrl, json_encode($searchData));
        $curl->close();

        return json_decode($curl->response->d);
    }
}