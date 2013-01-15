<?php

namespace Db\Model;

use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;

abstract class AbstractModel
{
    use Component\ServiceManager
        , Component\EventManager
        ;

    public function __construct(ServiceManager $serviceManager) {
        $this->setServiceManager($serviceManager);
    }
}