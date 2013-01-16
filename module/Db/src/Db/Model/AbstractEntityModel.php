<?php

namespace Db\Model;

use Db\Model\AbstractModel
    , Zend\InputFilter\InputFilter
    , Zend\ServiceManager\ServiceManager
    , Doctrine\ORM\EntityManager
    ;

abstract class AbstractEntityModel extends AbstractModel
{
    use Component\Entity
        ;

    public function __construct(ServiceManager $serviceManager, EntityManager $entityManager) {
        $this->setServiceManager($serviceManager);
        $this->setEntityManager($entityManager);
    }
}