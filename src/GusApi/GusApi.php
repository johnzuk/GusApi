<?php

declare(strict_types=1);

namespace GusApi;

use DateTimeImmutable;
use DateTimeZone;
use GusApi\Client\Builder;
use GusApi\Client\BuilderInterface;
use GusApi\Client\GusApiClient;
use GusApi\Exception\InvalidReportTypeException;
use GusApi\Exception\InvalidServerResponseException;
use GusApi\Exception\InvalidUserKeyException;
use GusApi\Exception\NotFoundException;
use GusApi\Type\Request\GetBulkReport;
use GusApi\Type\Request\GetFullReport;
use GusApi\Type\Request\GetValue;
use GusApi\Type\Request\Login;
use GusApi\Type\Request\Logout;
use GusApi\Type\Request\SearchData;
use GusApi\Type\Request\SearchParameters;
use GusApi\Type\Response\SearchResponseCompanyData;

/**
 * @author Janusz Żukowicz <john_zuk@wp.pl>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
class GusApi
{
    protected const MAX_IDENTIFIERS = 20;

    protected const SERVICE_TIME_ZONE = 'Europe/Warsaw';

    protected const SERVICE_STATUS_DATE_FORMAT = 'd-m-Y';
    protected GusApiClient $apiClient;
    private string $sessionId;

    public function __construct(private string $userKey, string $env = 'prod', ?BuilderInterface $builder = null)
    {
        $builder ??= new Builder($env);
        $this->apiClient = $builder->build();
    }

    public static function createWithApiClient(string $userKey, GusApiClient $apiClient): self
    {
        return new self($userKey, 'prod', new Builder('prod', $apiClient));
    }

    public function getSessionId(): string
    {
        $this->ensureSession();

        return $this->sessionId;
    }

    public function setSessionId(string $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @throws InvalidUserKeyException
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

    public function logout(): bool
    {
        return $this->apiClient->logout(new Logout($this->sessionId))->getWylogujResult();
    }

    public function isLogged(): bool
    {
        if (!isset($this->sessionId)) {
            return false;
        }

        return (bool) $this->getSessionStatus();
    }

    /**
     * @throws InvalidServerResponseException
     */
    public function dataStatus(): DateTimeImmutable
    {
        $this->ensureSession();
        $result = $this->apiClient->getValue(
            new GetValue(ParamName::STATUS_DATE_STATE),
            $this->sessionId
        );

        $dataStatus = DateTimeImmutable::createFromFormat(
            self::SERVICE_STATUS_DATE_FORMAT,
            $result->getGetValueResult(),
            new DateTimeZone(self::SERVICE_TIME_ZONE)
        );

        if (false === $dataStatus) {
            throw new InvalidServerResponseException(sprintf('Invalid response, expected date in format "%s" given %s', self::SERVICE_STATUS_DATE_FORMAT, $result->getGetValueResult()));
        }

        return $dataStatus;
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

    public function serviceMessage(): string
    {
        return $this->apiClient->getValue(new GetValue(ParamName::SERVICE_MESSAGE))->getGetValueResult();
    }

    /**
     * @throws NotFoundException
     *
     * @return SearchReport[]
     */
    public function getByNip(string $nip): array
    {
        return $this->search(
            new SearchData(
                new SearchParameters(null, null, $nip, null, null, null, null)
            )
        );
    }

    /**
     * @throws NotFoundException
     *
     * @return array|SearchReport[]
     */
    public function getByRegon(string $regon): array
    {
        return $this->search(
            new SearchData(
                new SearchParameters(null, null, null, null, $regon, null, null)
            )
        );
    }

    /**
     * @throws NotFoundException
     *
     * @return array|SearchReport[]
     */
    public function getByKrs(string $krs): array
    {
        return $this->search(
            new SearchData(
                new SearchParameters($krs, null, null, null, null, null, null)
            )
        );
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

        return $this->search(
            new SearchData(
                new SearchParameters(null, null, null, implode(',', $nips), null, null, null)
            )
        );
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

        return $this->search(
            new SearchData(
                new SearchParameters(null, implode(',', $krses), null, null, null, null, null)
            )
        );
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

        return $this->search(
            new SearchData(
                new SearchParameters(null, null, null, null, null, null, implode(',', $regons))
            )
        );
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

        return $this->search(
            new SearchData(
                new SearchParameters(null, null, null, null, null, implode(',', $regons), null)
            )
        );
    }

    /**
     * @throws InvalidReportTypeException
     *
     * @return array<int, array<string, string>>
     */
    public function getFullReport(SearchReport $searchReport, string $reportName): array
    {
        $this->ensureSession();
        $result = $this->apiClient->getFullReport(
            new GetFullReport(
                ReportRegonNumberMapper::getRegonNumberByReportName($searchReport, $reportName),
                $reportName
            ),
            $this->sessionId
        );

        return $result->getReport();
    }

    /**
     * @throws InvalidReportTypeException
     */
    public function getBulkReport(DateTimeImmutable $date, string $reportName): array
    {
        $this->ensureSession();
        if (!\in_array($reportName, BulkReportTypes::REPORTS, true)) {
            throw new InvalidReportTypeException(sprintf('Invalid report type: "%s", use one of allowed type: (%s)', $reportName, implode(', ', BulkReportTypes::REPORTS)));
        }

        return $this->apiClient->getBulkReport(
            new GetBulkReport($date->format('Y-m-d'), $reportName),
            $this->sessionId
        );
    }

    /**
     * Return message code if search not found record.
     */
    public function getMessageCode(): int
    {
        $this->ensureSession();
        $result = $this->apiClient->getValue(
            new GetValue(ParamName::MESSAGE_CODE),
            $this->sessionId
        );

        return (int) $result->getGetValueResult();
    }

    /**
     * Return message text id search not found record.
     */
    public function getMessage(): string
    {
        $this->ensureSession();
        $result = $this->apiClient->getValue(new GetValue(ParamName::MESSAGE), $this->sessionId);

        return $result->getGetValueResult();
    }

    public function getSessionStatus(): int
    {
        $this->ensureSession();
        $response = $this->apiClient->getValue(
            new GetValue(ParamName::SESSION_STATUS),
            $this->sessionId
        );

        return (int) $response->getGetValueResult();
    }

    private function checkIdentifiersCount(array $identifiers): void
    {
        if (\count($identifiers) > self::MAX_IDENTIFIERS) {
            throw new \InvalidArgumentException(sprintf('Too many identifiers. Maximum allowed is %d.', self::MAX_IDENTIFIERS));
        }
    }

    /**
     * @throws NotFoundException
     *
     * @return SearchReport[]
     */
    private function search(SearchData $searchData): array
    {
        $this->ensureSession();
        $result = $this->apiClient->searchData($searchData, $this->sessionId);

        return array_map(static fn (SearchResponseCompanyData $company): SearchReport => new SearchReport($company), $result->getDaneSzukajResult());
    }

    private function ensureSession(): void
    {
        if (!isset($this->sessionId)) {
            throw new \BadMethodCallException('Session is not started. Call login() first.');
        }
    }
}
