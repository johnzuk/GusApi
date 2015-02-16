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

    /**
     * @var string
     */
    private $captchaFileName = "captcha.jpeg";

    private $loginUrl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/Zaloguj';

    private $getCaptchaUrl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/PobierzCaptcha';

    private $checkCaptchaUrl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/SprawdzCaptcha';

    private $searchDataUrl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/daneSzukaj';

    private $getComplexDataUrl = 'https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/DanePobierzPelnyRaport';

    private $captchaStatus = false;

    public function __construct()
    {
        $this->login();
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

        return $this;
    }

    public function getCaptcha()
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('sid', $this->sid );
        $curl->post($this->getCaptchaUrl,'');

        $image = fopen($this->captchaFileName,'w+');
        if(!$image)
        {
            throw new \Exception("NO file!");
        }

        fwrite($image, base64_decode($curl->response->d));
        fclose($image);

        $curl->close();

        return $this;
    }

    public function checkCaptcha($captcha)
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('sid', $this->sid);
        $curl->post($this->checkCaptchaUrl, json_encode(array('pCaptcha'=>$captcha)));
        $curl->close();

        $this->captchaStatus = (bool)$curl->response->d;
        return $this->captchaStatus;
    }

    public function getInfoByNip($nip)
    {
        $basicInfo = $this->getBasicInfoByNip($nip);

        return $this->getComplexData($basicInfo[0]->Regon);
    }

    public function getInfoByRegon($regon)
    {
        $basicInfo = $this->getBasicInfoByRegon($regon);

        return $this->getComplexData($basicInfo[0]->Regon);
    }

    public function getInfoByKrs($krs)
    {
        $basicInfo = $this->getBasicInfoByKrs($krs);

        return $this->getComplexData($basicInfo[0]->Regon);
    }

    public function getBasicInfoByNip($nip)
    {
        $this->clearSearch();
        $this->searchData['pParametryWyszukiwania']['Nip'] = $nip;
        return $this->search();
    }

    public function getBasicInfoByRegon($regon)
    {
        $this->clearSearch();
        $this->searchData['pParametryWyszukiwania']['Regon'] = $regon;
        return $this->search();
    }

    public function getBasicInfoByKrs($krs)
    {
        $this->clearSearch();
        $this->searchData['pParametryWyszukiwania']['Krs'] = $krs;
        return $this->search();
    }

    public function getCaptchaStatus()
    {
        return $this->captchaStatus;
    }

    private function getComplexData($regon)
    {
        $searchData = [
            'pNazwaRaportu'=>'DaneRaportPrawnaPubl',
            'pRegon' => $regon,
            'pSilosID' => 0
        ];

        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('sid', $this->sid);
        $curl->post($this->getComplexDataUrl, json_encode($searchData));
        $curl->close();

        $response = json_decode($curl->response->d);
        return $response[0];
    }

    private function clearSearch()
    {
        array_walk($this->searchData['pParametryWyszukiwania'],function($item,$key){ return null; });
    }

    private function search()
    {
        $curl = new Curl();
        $curl->setHeader('Content-Type', 'application/json');
        $curl->setHeader('sid', $this->sid);
        $curl->post($this->searchDataUrl, json_encode($this->searchData));
        $curl->close();

        return json_decode($curl->response->d);
    }
}