<?php

namespace Db\Model;

use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;

abstract class AbstractModel
{
    use Component\ServiceManager
        , Component\EventManager
        , Component\EntityManager
        ;

    public function __construct(ServiceManager $serviceManager, EntityManager $entityManager) {
        $this->setServiceManager($serviceManager);
        $this->setEntityManager($entityManager);
    }
}