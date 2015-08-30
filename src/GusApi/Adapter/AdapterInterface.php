<?php
namespace GusApi\Adapter;

/**
 * Interface AdapterInterface interface of GUS api adapter
 * @package GusApi\Adapter\
 */
interface AdapterInterface
{
    /**
     * Login in to regon server
     *
     * @param string $userKey twenty-character user key eg. <b>aaaaaabbbbbcccccdddd</b>
     * @return string session id - used in other actions
     */
    public function login($userKey);

    /**
     * Logout from regon server
     *
     * @param string $sid session id
     * @return bool logout status
     */
    public function logout($sid);

    /**
     * Return base64 encoding captcha image
     *
     * @param string $sid session id
     * @return string base64 encoding image
     */
    public function getCaptcha($sid);

    /**
     * Check captcha value
     *
     * @param string $sid session id
     * @param string $captcha captcha value
     * @return bool check captcha status
     */
    public function checkCaptcha($sid, $captcha);

    /**
     * Search data in regon server
     *
     * @param string $sid session id
     * @param array $parameters search parameters
     * @return mixed
     */
    public function search($sid, array $parameters);

    /**
     * Get full report data from regon server
     *
     * @param string $sid session id
     * @param $regon
     * @param $reportType
     * @return mixed
     */
    public function getFullData($sid, $regon, $reportType);

    /**
     * Get value
     *
     * @param string $sid session id
     * @param $param
     * @return mixed
     */
    public function getValue($sid, $param);

    /**
     * Get actual message from regon server
     *
     * @return string message from regon system
     */
    public function getMessage();
}