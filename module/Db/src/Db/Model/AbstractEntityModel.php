<?php

namespace Db\Model;

use Db\Model\AbstractModel;
use Zend\InputFilter\InputFilter;
use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;

abstract class AbstractEntityModel extends AbstractModel
{
    use Component\Entity
        ;

    public function __construct(ServiceManager $serviceManager, EntityManager $entityManager) {
        $this->setServiceManager($serviceManager);
        $this->setEntityManager($entityManager);
    }
}