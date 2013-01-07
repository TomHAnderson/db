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
        $http = new Client();
        $uri = 'http://api.jambase.com/search';
        $http->setUri($uri);
        $http->setMethod('GET');
        $http->setOptions(array('sslverifypeer' => false));

        $http->setParameterGet(array(
            'apikey' => $this->getApiKey()
        ));

        foreach ((array)$parameters as $key => $val) {
            $http->setParameterGet(array(
                $key => $val
            ));
        }

        $response = $http->send();
        $content = $response->getBody();
print_r($response);
die('jambase api');
//        return Json::decode($content);
    }
}