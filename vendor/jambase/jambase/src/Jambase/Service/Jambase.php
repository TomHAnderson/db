<?php

namespace Jambase\Service;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result,
    Zend\Http\Client,
    Zend\Json\Json;

class Jambase
{
    static private $apiKey;

    static public function configure($apiKey)
    {
        self::setApiKey($apiKey);
    }

    static public function getApiKey()
    {
        return self::$apiKey;
    }

    static public function setApiKey($value)
    {
        self::$apiKey = $value;
    }

    static public function search($parameters = array())
    {
        if (!self::getApiKey())
            throw new \Exception('Invalid API Key');

        $http = new Client();
        $uri = 'http://api.jambase.com/search';
        $http->setUri($uri);
        $http->setMethod('GET');
        $http->setOptions(array('sslverifypeer' => false));

        $parameters['apikey'] = self::getApiKey();
        $http->setParameterGet($parameters);

        $response = $http->send();
        $responseXml = simplexml_load_string($response->getBody());

        return $responseXml;
    }
}