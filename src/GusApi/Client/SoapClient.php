<?php
namespace GusApi\Client;

class SoapClient extends \SoapClient
{
    protected $context;

    /**
     * @inheritdoc
     */
    public function __construct($wsdl, array $options = null)
    {
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
     * @return string response
     */
    public function __doRequest($request, $location, $action, $version = SOAP_1_2) {
        $response = parent::__doRequest($request, $location, $action, $version);
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