<?php

namespace Db\Model;

use Db\Model\AbstractModel
    , Zend\InputFilter\InputFilter
    , Zend\ServiceManager\ServiceManager
    , Doctrine\ORM\EntityManager
    , Doctrine\ORM\EntityRepository
    ;

abstract class AbstractEntityModel extends EntityRepository
{
    use Component\Entity
        , Component\ServiceManager
        , Component\EventManager
        ;

    public function __construct(ServiceManager $serviceManager, EntityManager $entityManager) {
        $this->setServiceManager($serviceManager);
        $this->setEntityManager($entityManager);
    }
}