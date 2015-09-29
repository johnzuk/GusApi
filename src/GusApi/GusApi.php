<?php
namespace GusApi;

use GusApi\Adapter\AdapterInterface;
use GusApi\Adapter\Soap\Exception\NoDataException;
use GusApi\Adapter\Soap\SoapAdapter;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\Exception\NotFoundException;

/**
 * Class GusApi
 *
 * @package GusApi
 * @author Janusz Żukowicz <john_zuk@wp.pl>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
class GusApi
{

    /**
     * @var string user key
     */
    protected $userKey;

    /**
     * @var AdapterInterface connection adapter
     */
    protected $adapter;

    /**
     * @param $userKey
     * @param AdapterInterface|null $adapter
     */
    public function __construct($userKey, AdapterInterface $adapter = null)
    {
        $this->userKey = $userKey;

        if ($adapter === null) {
            $adapter = new SoapAdapter(RegonConstantsInterface::BASE_WSDL_URL_TEST, RegonConstantsInterface::BASE_WSDL_ADDRESS_TEST);
        }

        $this->adapter = $adapter;
    }

    /**
     * Login in to regon server
     *
     * @return string session id value
     */
    public function login()
    {
        $sid = $this->adapter->login($this->userKey);

        if (empty($sid)) {
            throw new InvalidUserKeyException(sprintf("User key '%s' is invalid", $this->userKey));
        }

        return $sid;
    }

    /**
     * Logout from regon server
     *
     * @param string $sid session id
     * @return bool logout status
     */
    public function logout($sid)
    {
        return $this->adapter->logout($sid);
    }

    /**
     * Tells whether the your status is login
     *
     * @param string $sid session id
     * @return bool login status
     */
    public function isLogged($sid)
    {
        return $this->adapter->getValue($sid, RegonConstantsInterface::PARAM_SESSION_STATUS);
    }

    /**
     * Get actual data status
     *
     * @param string $sid session id
     * @return \DateTime data status date time value
     */
    public function dataStatus($sid)
    {
        return new \DateTime($this->adapter->getValue($sid, RegonConstantsInterface::PARAM_STATUS_DATE_STATE));
    }

    /**
     * Get service status:
     * <p>
     * <b>0</b> - service unavailable <br>
     * <b>1</b> - service available <br>
     * <b>2</b> - service technical break <br>
     * </p>
     *
     * @return int actual service status
     */
    public function serviceStatus()
    {
        return (int) $this->adapter->getValue(null, RegonConstantsInterface::PARAM_SERVICE_STATUS);
    }

    /**
     * Return service message
     *
     * @return string service message
     */
    public function serviceMessage()
    {
        return $this->adapter->getValue(null, RegonConstantsInterface::PARAM_SERVICE_MESSAGE);
    }

    /**
     * Return base64 encoding captcha image
     *
     * @param string $sid session id
     * @return string base64 encoding image
     */
    public function getCaptcha($sid)
    {
        return $this->adapter->getCaptcha($sid);
    }

    /**
     * Check captcha value
     *
     * @param string $sid session id
     * @param string $captcha captcha value
     * @return bool checl status
     */
    public function checkCaptcha($sid, $captcha)
    {
        return $this->adapter->checkCaptcha($sid, $captcha);
    }

    /**
     * Get basic information by NIP number
     *
     * @param string $sid session id
     * @param string $nip NIP number
     * @return SearchReport search subject information object
     * @throws NotFoundException
     */
    public function getByNip($sid, $nip)
    {
        return $this->search($sid, [
            RegonConstantsInterface::SEARCH_TYPE_NIP => $nip
        ]);
    }

    /**
     * Get basic information by REGON number
     *
     * @param $sid
     * @param $regon
     * @return SearchReport search subject information object
     * @throws NotFoundException
     */
    public function getByRegon($sid, $regon)
    {
        return $this->search($sid, [
            RegonConstantsInterface::SEARCH_TYPE_REGON => $regon
        ]);
    }

    /**
     * Get basic information by KRS number
     *
     * @param $sid
     * @param $krs
     * @return SearchReport search subject information object
     * @throws NotFoundException
     */
    public function getByKrs($sid, $krs)
    {
        return $this->search($sid, [
            RegonConstantsInterface::SEARCH_TYPE_KRS => $krs
        ]);
    }

    /**
     * @param $sid
     * @param SearchReport $searchReport
     * @param $reportType
     * @return mixed|\SimpleXMLElement
     */
    public function getFullReport($sid, SearchReport $searchReport, $reportType)
    {
        $result = $this->adapter->getFullData($sid, $searchReport->getRegon14(), $reportType);

        return $result;
    }

    /**
     * Get get message about search if you don't get data
     *
     * @return string
     */
    public function getResultSearchMessage()
    {
        return $this->adapter->getMessage();
    }

    /**
     * @param $sid
     * @param array $searchData
     * @return SearchReport
     * @throws NotFoundException
     */
    private function search($sid, array $searchData)
    {
        try{
            $response = $this->adapter->search($sid, $searchData);
        } catch (NoDataException $e) {
            throw new NotFoundException(sprintf("Not found subject"));
        }

        return new SearchReport($response[0]);
    }
}