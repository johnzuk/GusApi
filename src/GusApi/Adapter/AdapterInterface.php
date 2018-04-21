<?php
namespace GusApi\Adapter;

/**
 * Interface AdapterInterface interface of GUS api adapter
 *
 * @package GusApi\Adapter\
 */
interface AdapterInterface
{
    /**
     * Login in to regon server
     *
     * @param  string $userKey twenty-character user key eg. <b>abcde12345abcde12345</b>
     * @return string session id - used in other actions
     */
    public function login($userKey);

    /**
     * Logout from regon server
     *
     * @param  string $sid session id
     * @return bool logout status
     */
    public function logout($sid);

    /**
     * Search data in regon server
     *
     * @param  string $sid        session id
     * @param  array  $parameters search parameters
     * @return mixed
     */
    public function search($sid, array $parameters);

    /**
     * Get full report data from regon server
     *
     * @param  string     $sid session id
     * @param  $regon
     * @param  $reportType
     * @return mixed
     */
    public function getFullData($sid, $regon, $reportType);

    /**
     * Get value
     *
     * @param  string $sid session id
     * @param  $param - available param names: ["StatusSesji", "KomunikatKod", "KomunikatTresc"]
     * @return mixed
     */
    public function getValue($sid, $param);
}
