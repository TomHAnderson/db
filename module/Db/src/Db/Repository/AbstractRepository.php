<?php

namespace Db\Repository;
use Db\Model\AbstractModel
    , Zend\InputFilter\InputFilter
    , Zend\ServiceManager\ServiceManager
    , Doctrine\ORM\EntityManager
    , Doctrine\ORM\EntityRepository
    ;

abstract class AbstractRepository extends EntityRepository
{
/*
//    use Component\Entity
    use Component\ServiceManager
        , Component\EventManager
        ;

    public function __construct(ServiceManager $serviceManager, EntityManager $entityManager) {
        $this->setServiceManager($serviceManager);
        $this->setEntityManager($entityManager);
    }
*/
}