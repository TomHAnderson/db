<?php

namespace Db\Model\Component;
use Zend\ServiceManager\ServiceManager as ZendServiceManager;

trait ServiceManager
{
    private $serviceManager;

    public function setServiceManager(ZendServiceManager $manager) {
        $this->serviceManager = $manager;
        return $this;
    }

    public function getServiceManager() {
        return $this->serviceManager;
    }
}