<?php

namespace Jambase\Service;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result,
    Zend\Http\Client,
    Zend\Json\Json;

class Jambase
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->setApiKey($apiKey);
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setApiKey($value)
    {
        $this->apiKey = $value;
        return $this;
    }

    public function search($parameters = array())
    {
        if (!$this->getApiKey())
            throw new \Exception('Invalid API Key');

        $http = new Client();
        $uri = 'http://api.jambase.com/search';
        $http->setUri($uri);
        $http->setMethod('GET');
        $http->setOptions(array('sslverifypeer' => false));

        $parameters['apikey'] = $this->getApiKey();
        $http->setParameterGet($parameters);

        $response = $http->send();
        $content = $response->getBody();

        return Json::decode($content);
    }
}