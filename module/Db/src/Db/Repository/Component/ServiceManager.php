<?php

namespace Db\Model\Component;
use Zend\ServiceManager\ServiceManager as ZendServiceManager;

trait ServiceManager
{
    private $serviceManager;

    public function setServiceManager(ZendServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function getServiceManager() {
        return $this->serviceManager;
    }
}