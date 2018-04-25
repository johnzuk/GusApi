<?php

namespace GusApi;

use GusApi\Client\Builder;
use GusApi\Client\BuilderInterface;
use GusApi\Client\GusApiClient;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\Exception\NotFoundException;
use GusApi\Type\Request\GetFullReport;
use GusApi\Type\Request\GetValue;
use GusApi\Type\Request\Login;
use GusApi\Type\Request\Logout;
use GusApi\Type\Request\SearchData;
use GusApi\Type\Response\SearchResponseCompanyData;
use GusApi\Type\SearchParameters;

/**
 * @author Janusz Żukowicz <john_zuk@wp.pl>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
class GusApi
{
    const MAX_IDENTIFIERS = 20;

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
     *
     * @param string                $userKey
     * @param string                $env
     * @param BuilderInterface|null $builder
     */
    public function __construct(string $userKey, string $env = 'prod', ?BuilderInterface $builder = null)
    {
        $builder = $builder ?: new Builder($env);
        $this->apiClient = $builder->build();
        $this->userKey = $userKey;
    }

    /**
     * @param string       $userKey
     * @param GusApiClient $apiClient
     *
     * @return GusApi
     */
    public static function createWithApiClient(string $userKey, GusApiClient $apiClient): self
    {
        return new self($userKey, 'prod', new Builder('prod', $apiClient));
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
     * @throws InvalidUserKeyException
     *
     * @return bool
     */
    public function login(): bool
    {
        $result = $this->apiClient->login(new Login($this->userKey));

        if (empty($result->getZalogujResult())) {
            throw new InvalidUserKeyException(sprintf("User key '%s' is invalid", $this->userKey));
        }

        $this->sessionId = $result->getZalogujResult();

        return true;
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
        return (bool) $this->getSessionStatus();
    }

    /**
     * @return \DateTime
     */
    public function dataStatus(): \DateTime
    {
        $result = $this->apiClient->getValue(
            new GetValue(ParamName::STATUS_DATE_STATE),
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
     * </p>.
     *
     * @return int actual service status
     */
    public function serviceStatus(): int
    {
        $result = $this->apiClient->getValue(new GetValue(ParamName::SERVICE_STATUS));

        return (int) $result->getGetValueResult();
    }

    /**
     * @return string
     */
    public function serviceMessage(): string
    {
        $result = $this->apiClient->getValue(new GetValue(ParamName::SERVICE_MESSAGE));

        return $result->getGetValueResult();
    }

    /**
     * @param string $nip
     *
     * @throws NotFoundException
     *
     * @return SearchReport[]
     */
    public function getByNip(string $nip): array
    {
        return $this->search(SearchType::NIP, $nip);
    }

    /**
     * @param string $regon
     *
     * @throws NotFoundException
     *
     * @return array|SearchReport[]
     */
    public function getByRegon(string $regon): array
    {
        return $this->search(SearchType::REGON, $regon);
    }

    /**
     * @param string $krs
     *
     * @throws NotFoundException
     *
     * @return array|SearchReport[]
     */
    public function getByKrs(string $krs): array
    {
        return $this->search(SearchType::KRS, $krs);
    }

    /**
     * @param string[] $nips
     *
     * @throws NotFoundException
     *
     * @return array|SearchReport[]
     */
    public function getByNips(array $nips): array
    {
        $this->checkIdentifiersCount($nips);

        return $this->search(SearchType::NIPS, implode(',', $nips));
    }

    /**
     * @param string[] $krses
     *
     * @throws NotFoundException
     *
     * @return array|SearchReport[]
     */
    public function getByKrses(array $krses): array
    {
        $this->checkIdentifiersCount($krses);

        return $this->search(SearchType::KRSES, implode(',', $krses));
    }

    /**
     * @param string[] $regons
     *
     * @throws NotFoundException
     *
     * @return array|SearchReport[]
     */
    public function getByRegons9(array $regons): array
    {
        $this->checkIdentifiersCount($regons);

        return $this->search(SearchType::REGONS_9, implode(',', $regons));
    }

    /**
     * @param string[] $regons
     *
     * @throws NotFoundException
     *
     * @return array|SearchReport[]
     */
    public function getByregons14(array $regons): array
    {
        $this->checkIdentifiersCount($regons);

        return $this->search(SearchType::REGONS_14, implode(',', $regons));
    }

    /**
     * @param SearchReport $searchReport
     * @param string       $reportType
     *
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
     * Get message about search if you don't get data.
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
     * Return message code if search not found record.
     *
     * @return int
     */
    public function getMessageCode(): int
    {
        $result = $this->apiClient->getValue(
            new GetValue(ParamName::MESSAGE_CODE),
            $this->sessionId
        );

        return (int) $result->getGetValueResult();
    }

    /**
     * Return message text id search not found record.
     *
     * @return string
     */
    public function getMessage(): string
    {
        $result = $this->apiClient->getValue(new GetValue(ParamName::MESSAGE), $this->sessionId);

        return $result->getGetValueResult();
    }

    /**
     * @return int
     */
    public function getSessionStatus(): int
    {
        $response = $this->apiClient->getValue(
            new GetValue(ParamName::SESSION_STATUS),
            $this->sessionId
        );

        return (int) $response->getGetValueResult();
    }

    /**
     * @param string[] $identifiers
     *
     * @throws \InvalidArgumentException
     */
    protected function checkIdentifiersCount(array $identifiers)
    {
        if (count($identifiers) > self::MAX_IDENTIFIERS) {
            throw new \InvalidArgumentException(sprintf(
                'Too many identifiers. Maximum allowed is %d.',
                self::MAX_IDENTIFIERS
            ));
        }
    }

    /**
     * @param string $searchType
     * @param string $parameters
     *
     * @throws NotFoundException
     *
     * @return SearchReport[]
     */
    private function search(string $searchType, string $parameters): array
    {
        $method = 'set'.$searchType;
        $searchParameters = new SearchParameters();
        $searchParameters->$method($parameters);

        $result = $this->apiClient->searchData(new SearchData($searchParameters), $this->sessionId);

        return array_map(function (SearchResponseCompanyData $company) {
            return new SearchReport($company);
        }, $result->getDaneSzukajResult());
    }
}
