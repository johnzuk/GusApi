<?php
namespace GusApi;

use GusApi\Client\Builder;
use GusApi\Client\BuilderInterface;
use GusApi\Client\GusApiClient;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\Exception\NotFoundException;
use GusApi\Type\GetFullReport;
use GusApi\Type\GetValue;
use GusApi\Type\Login;
use GusApi\Type\Logout;
use GusApi\Type\SearchData;
use GusApi\Type\SearchParameters;

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
     * @var GusApiClient
     */
    protected $apiClient;

    /**
     * @var string
     */
    protected $sessionId;

    /**
     * GusApi constructor.
     * @param string $userKey
     * @param string $env
     * @param BuilderInterface|null $builder
     */
    public function __construct(string $userKey, string $env = 'prod', ?BuilderInterface $builder = null)
    {
        $builder = $builder ?: new Builder($env);
        $this->apiClient = $builder->build();
        $this->userKey = $userKey;
    }

    /**
     * @param string $userKey
     * @param GusApiClient $apiClient
     * @return GusApi
     */
    public static function createWithApiClient(string $userKey, GusApiClient $apiClient): self
    {
        return new self($userKey, new Builder('', $apiClient));
    }

    /**
     * @return string
     */
    public function getUserKey(): string
    {
        return $this->userKey;
    }

    /**
     * @param string $userKey
     */
    public function setUserKey(string $userKey): void
    {
        $this->userKey = $userKey;
    }

    /**
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     */
    public function setSessionId(string $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    /**
     * Login in to regon server
     *
     * @return string session id value
     */
    public function login(): string
    {
        $result = $this->apiClient->login(new Login($this->userKey));

        if (empty($result->getZalogujResult())) {
            throw new InvalidUserKeyException(sprintf("User key '%s' is invalid", $this->userKey));
        }

        $this->sessionId = $result->getZalogujResult();
        return $this->sessionId;
    }

    /**
     * @return bool
     */
    public function logout(): bool
    {
        $response = $this->apiClient->logout(new Logout($this->sessionId));

        return $response->getWylogujResult();
    }

    /**
     * @return bool
     */
    public function isLogged(): bool
    {
        return (bool)$this->getSessionStatus();
    }

    /**
     * @return \DateTime
     */
    public function dataStatus(): \DateTime
    {
        $result = $this->apiClient->getValue(
            new GetValue(RegonConstantsInterface::PARAM_STATUS_DATE_STATE),
            $this->sessionId
        );

        return new \DateTime($result->getGetValueResult());
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
    public function serviceStatus(): int
    {
        $result = $this->apiClient->getValue(new GetValue(RegonConstantsInterface::PARAM_SERVICE_STATUS));

        return (int)$result->getGetValueResult();
    }

    /**
     * Return service message
     *
     * @return string service message
     */
    public function serviceMessage(): string
    {
        $result = $this->apiClient->getValue(new GetValue(RegonConstantsInterface::PARAM_SERVICE_MESSAGE));

        return $result->getGetValueResult();
    }

    /**
     * @param string $nip
     * @return SearchReport[]
     * @throws NotFoundException
     */
    public function getByNip(string $nip): array
    {
        return $this->search(RegonConstantsInterface::SEARCH_TYPE_NIP, $nip);
    }

    /**
     * @param string $regon
     * @return array|SearchReport[]
     * @throws NotFoundException
     */
    public function getByRegon(string $regon)
    {
        return $this->search(RegonConstantsInterface::SEARCH_TYPE_REGON, $regon);
    }

    /**
     * @param string $krs
     * @return array|SearchReport[]
     * @throws NotFoundException
     */
    public function getByKrs(string $krs)
    {
        return $this->search(RegonConstantsInterface::SEARCH_TYPE_KRS, $krs);
    }

    /**
     * @param array $nips
     * @return array|SearchReport[]
     * @throws NotFoundException
     */
    public function getByNips(array $nips)
    {
        if (count($nips) > 20) {
            throw new \InvalidArgumentException("Too many NIP numbers. Maximum quantity is 20.");
        }
        $nips = implode(',', $nips);

        return $this->search(RegonConstantsInterface::SEARCH_TYPE_NIPS, $nips);
    }

    /**
     * @param array $krses
     * @return array|SearchReport[]
     * @throws NotFoundException
     */
    public function getByKrses(array $krses)
    {
        if (count($krses) > 20) {
            throw new \InvalidArgumentException("Too many KRS numbers. Maximum quantity is 20.");
        }
        $krses = implode(',', $krses);

        return $this->search(RegonConstantsInterface::SEARCH_TYPE_KRSES, $krses);
    }

    /**
     * @param array $regons
     * @return array|SearchReport[]
     * @throws NotFoundException
     */
    public function getByRegons9(array $regons)
    {
        if (count($regons) > 20) {
            throw new \InvalidArgumentException("Too many REGON numbers. Maximum quantity is 20.");
        }
        $regons = implode(',', $regons);

        return $this->search(RegonConstantsInterface::SEARCH_TYPE_REGONS_9, $regons);
    }

    /**
     * @param array $regons
     * @return array|SearchReport[]
     * @throws NotFoundException
     */
    public function getByregons14(array $regons)
    {
        if (count($regons) > 20) {
            throw new \InvalidArgumentException("Too many REGON numbers. Maximum quantity is 20.");
        }
        $regons = implode(',', $regons);

        return $this->search(RegonConstantsInterface::SEARCH_TYPE_REGONS_14, $regons);
    }

    /**
     * @param SearchReport $searchReport
     * @param string $reportType
     * @return \SimpleXMLElement
     */
    public function getFullReport(SearchReport $searchReport, string $reportType): \SimpleXMLElement
    {
        $result = $this->apiClient->getFullReport(
            new GetFullReport($searchReport->getRegon14(), $reportType),
            $this->sessionId
        );

        return $result->getReport();
    }

    /**
     * Get message about search if you don't get data
     *
     * @return string
     */
    public function getResultSearchMessage(): string
    {
        return sprintf(
            "StatusSesji:%s\nKomunikatKod:%s\nKomunikatTresc:%s\n",
            $this->getSessionStatus(),
            $this->getMessageCode(),
            $this->getMessage()
        );
    }

    /**
     * Return message code if search not found record
     * @return int
     */
    public function getMessageCode(): int
    {
        $result = $this->apiClient->getValue(new GetValue(RegonConstantsInterface::PARAM_MESSAGE_CODE), $this->sessionId);

        return (int)$result->getGetValueResult();
    }

    /**
     * Return message text id search not found record
     * @return string
     */
    public function getMessage()
    {
        $result = $this->apiClient->getValue(new GetValue(RegonConstantsInterface::PARAM_MESSAGE), $this->sessionId);

        return $result->getGetValueResult();
    }

    /**
     * @return int
     */
    public function getSessionStatus(): int
    {
        $response = $this->apiClient->getValue(
            new GetValue(RegonConstantsInterface::PARAM_SESSION_STATUS),
            $this->sessionId
        );

        return (int)$response->getGetValueResult();
    }

    /**
     * @param string $searchType
     * @param string $parameters
     * @return SearchReport[]
     * @throws NotFoundException
     */
    private function search(string $searchType, string $parameters): array
    {
        $method = 'set'.$searchType;
        $searchParameters = new SearchParameters();
        $searchParameters->$method($parameters);

        $result = $this->apiClient->searchData(new SearchData($searchParameters), $this->sessionId);

        $response = [];

        foreach ($result->getDaneSzukajResult() as $company) {
            $response[] = new SearchReport($company);
        }

        return $response;
    }
}
