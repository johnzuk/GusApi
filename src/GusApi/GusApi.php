<?php
namespace GusApi;

use Curl\Curl;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\Exception\CurlException;
use GusApi\ReportType;

/**
 * Class GusApi
 * @package GusApi
 * @author Janusz Żukowicz <john_zuk@wp.pl>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
class GusApi
{
    const USER_KEY = "aaaaaabbbbbcccccdddd";

    const URL_BASIC = "https://wyszukiwarkaregon.stat.gov.pl/wsBIR/UslugaBIRzewnPubl.svc/ajaxEndpoint/";

    const URL_LOGIN = "Zaloguj";

    const URL_GET_CAPTCHA = "PobierzCaptcha";

    const URL_CHECK_CAPTCHA = "SprawdzCaptcha";

    const URL_SEARCH = "daneSzukaj";

    const URL_FULL_REPORT = "DanePobierzPelnyRaport";

    /**
     * @var Curl
     */
    private $curl;

    public function __construct()
    {
        $this->curl = new Curl();
        $this->curl->setHeader('Content-Type', 'application/json');
    }

    public function __destruct()
    {
        $this->curl->close();
    }

    /**
     * Login in to regin server
     *
     * @return string session id
     * @throws CurlException
     */
    public function login()
    {
        $this->preparePostData(self::URL_LOGIN, ["pKluczUzytkownika" => self::USER_KEY]);
        $sid = $this->getResponse();

        if (empty($sid)) {
            throw new InvalidUserKeyException("Invalid user key!");
        }

        return $sid;
    }

    /**
     * Get captcha base64 encoding image
     *
     * @param string $sid
     * @return string base64 encoding image
     * @throws CurlException
     */
    public function getCaptcha($sid)
    {
        $this->preparePostData(self::URL_GET_CAPTCHA, [], $sid);
        return $this->getResponse();
    }

    /**
     * Check captcha
     *
     * @param string $sid
     * @param string $captcha
     * @return bool
     * @throws CurlException
     */
    public function checkCaptcha($sid, $captcha)
    {
        $this->preparePostData(self::URL_CHECK_CAPTCHA, ['pCaptcha' => $captcha], $sid);
        return (bool)$this->getResponse();
    }

    /**
     *Get report data from nip
     *
     * @param string $sid
     * @param string $nip
     * @return SearchReport
     */
    public function getByNip($sid, $nip)
    {
        return $this->search($sid, [
            'pParametryWyszukiwania' => [
                'Nip' => $nip
            ]
        ]);
    }

    /**
     * Get report data from regon
     *
     * @param string $sid
     * @param string $regon
     * @return SearchReport
     */
    public function getByRegon($sid, $regon)
    {
        return $this->search($sid, [
            'pParametryWyszukiwania' => [
                'Regon' => $regon
            ]
        ]);
    }

    /**
     * Search by krs
     *
     * @param $sid
     * @param $krs
     * @return SearchReport
     */
    public function getByKrs($sid, $krs)
    {
        return $this->search($sid, [
            'pParametryWyszukiwania' => [
                'Krs' => $krs
            ]
        ]);
    }

    /**
     * Get complex data by regon number
     *
     * @param string $sid
     * @param string $regon
     * @param string $type
     * @return mixed
     * @throws CurlException
     */
    public function getFullData($sid, $regon, $type = ReportType::BASIC)
    {
        $searchData = [
            'pNazwaRaportu'=>$type,
            'pRegon' => $regon,
            'pSilosID' => 0
        ];

        $this->preparePostData(self::URL_FULL_REPORT, $searchData, $sid);
        $response = json_decode($this->getResponse());

        return $response[0];
    }

    /**
     * Get url address
     *
     * @param string $address
     * @return string server url
     */
    private function getUrl($address)
    {
        return self::URL_BASIC.$address;
    }

    /**
     * Prepare send data
     *
     * @param array $data
     * @return string json data
     */
    private function prepare(array $data)
    {
        return json_encode($data);
    }

    /**
     * Prepare post data
     *
     * @param string $address
     * @param array $data
     * @param null $sid
     */
    private function preparePostData($address, array $data, $sid = null)
    {
        if (!is_null($sid)) {
            $this->curl->setHeader('sid', $sid);
        }
        $this->curl->post($this->getUrl($address), $this->prepare($data));
    }

    /**
     * Return response server data
     *
     * @return mixed
     * @throws CurlException
     */
    private function getResponse()
    {
        if ($this->curl->error) {
            throw new CurlException($this->curl->error_message);
        }

        return $this->curl->response->d;
    }

    /**
     * Search data
     *
     * @param string $sid
     * @param array $searchData
     * @return SearchReport
     * @throws CurlException
     */
    private function search($sid, array $searchData)
    {
        $this->preparePostData(self::URL_SEARCH, $searchData, $sid);
        $response = json_decode($this->getResponse());

        return new SearchReport($response[0]);
    }
}