<?php

namespace Db\Model\Component;
use Zend\ServiceManager\ServiceLocatorInterface
    ;

trait ServiceLocator
{
    private $serviceLocator;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }
}