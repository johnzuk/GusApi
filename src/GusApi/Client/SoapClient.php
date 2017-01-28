<?php
namespace GusApi\Client;

/**
 * Class SoapClient provide a cient for a GUS server
 * @package GusApi\Client
 */
class SoapClient extends \SoapClient
{
    /**
     * @var resource
     */
    protected $context;

    /**
     * @var string location
     */
    protected $location;

    /**
     * SoapClient constructor.
     * @param string $wsdl
     * @param string $location
     * @param array|null $options
     */
    public function __construct($wsdl, $location, array $options = null)
    {
        $this->setLocation($location);
        $this->context = $this->createContext();
        $options['stream_context'] = $this->context;

        parent::__construct($wsdl, $options);
    }

    /**
     * Do request into regon server
     *
     * @param string $request request
     * @param string $location location
     * @param string $action action
     * @param int $version version
     * @param int $one_way [optional] <p>
     * If one_way is set to 1, this method returns nothing.
     * Use this where a response is not expected.
     * </p>
     * @return string response
     */
    public function __doRequest($request, $location, $action, $version = SOAP_1_2, $one_way = NULL) {
        $location = $this->location;
        $response = parent::__doRequest($request, $location, $action, $version, $one_way);
        $response = stristr(stristr($response, "<s:"), "</s:Envelope>", true) . "</s:Envelope>";
        return $response;
    }

    /**
     * Set http header into soap request
     *
     * @param array $header array of headers
     */
    public function __setHttpHeader(array $header)
    {
        $this->setContextOption([
            'http' => $header
        ]);
    }

    /**
     * Set location
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * Get location
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Create http context
     *
     * @return resource
     */
    private function createContext()
    {
        return stream_context_create();
    }

    /**
     * Add option to http context
     *
     * @param array $option
     */
    private function setContextOption(array $option)
    {
        stream_context_set_option($this->context, $option);
    }
}