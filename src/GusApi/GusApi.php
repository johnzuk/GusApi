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
     * @return string
     */
    public function getUserKey()
    {
        return $this->userKey;
    }

    /**
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
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
        return (bool)$this->sessionStatus($sid);
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
     * Get basic information by NIP number
     *
     * @param string $sid session id
     * @param string $nip NIP number
     * @return SearchReport[] search subject information object
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
     * @return SearchReport[] search subject information object
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
     * @return SearchReport[] search subject information object
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
     * @param array $nips Maxium quantity is 20.
     * @return SearchReport[]
     * @throws NotFoundException
     */
    public function getByNips($sid, array $nips)
    {
        if (count($nips) > 20) {
            throw new \InvalidArgumentException("Too many NIP numbers. Maximum quantity is 20.");
        }
        $nips = implode(',', $nips);

        return $this->search($sid, [
            RegonConstantsInterface::SEARCH_TYPE_NIPS => $nips
        ]);
    }

    /**
     * @param $sid
     * @param array $krses Maxium quantity is 20.
     * @return SearchReport[]
     * @throws NotFoundException
     */
    public function getByKrses($sid, array $krses)
    {
        if (count($krses) > 20) {
            throw new \InvalidArgumentException("Too many KRS numbers. Maximum quantity is 20.");
        }
        $krses = implode(',', $krses);

        return $this->search($sid, [
            RegonConstantsInterface::SEARCH_TYPE_KRSES => $krses
        ]);
    }

    /**
     * @param $sid
     * @param array $regons Maxium quantity is 20.
     * @return SearchReport[]
     * @throws NotFoundException
     */
    public function getByRegons9($sid, array $regons)
    {
        if (count($regons) > 20) {
            throw new \InvalidArgumentException("Too many REGON numbers. Maximum quantity is 20.");
        }
        $regons = implode(',', $regons);

        return $this->search($sid, [
            RegonConstantsInterface::SEARCH_TYPE_REGONS_9 => $regons
        ]);
    }

    /**
     * @param $sid
     * @param array $regons Maxium quantity is 20.
     * @return SearchReport[]
     * @throws NotFoundException
     */
    public function getByregons14($sid, array $regons)
    {
        if (count($regons) > 20) {
            throw new \InvalidArgumentException("Too many REGON numbers. Maximum quantity is 20.");
        }
        $regons = implode(',', $regons);

        return $this->search($sid, [
            RegonConstantsInterface::SEARCH_TYPE_REGONS_14 => $regons
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
     * @param $sid
     * @return string
     */
    public function getResultSearchMessage($sid)
    {
        return sprintf("StatusSesji:%s\nKomunikatKod:%s\nKomunikatTresc:%s\n",
            $this->sessionStatus($sid),
            $this->getMessageCode($sid),
            $this->getMessage($sid)
        );
    }

    /**
     * Return message code if search not found record
     * @param $sid
     * @return int
     */
    public function getMessageCode($sid)
    {
        return $this->adapter->getValue($sid, RegonConstantsInterface::PARAM_MESSAGE_CODE);
    }

    /**
     * Return message text id search not found record
     * @param $sid
     * @return string
     */
    public function getMessage($sid)
    {
        return $this->adapter->getValue($sid, RegonConstantsInterface::PARAM_MESSAGE);
    }

    /**
     * Return session status
     * @return int
     */
    public function sessionStatus($sid)
    {
        return $this->adapter->getValue($sid, RegonConstantsInterface::PARAM_SESSION_STATUS);
    }

    /**
     * @param $sid
     * @param array $searchData
     * @return SearchReport[]
     * @throws NotFoundException
     */
    private function search($sid, array $searchData)
    {
        $result = [];
        try{
            $response = $this->adapter->search($sid, $searchData);
        } catch (NoDataException $e) {
            throw new NotFoundException(sprintf("Not found subject"));
        }
        foreach ($response as $report) {
            $result[] = new SearchReport($report);
        }

        return $result;
    }
}
