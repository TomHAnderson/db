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
    public function findLike($search, $sort = array())
    {
        $query = $this->createQueryBuilder('s');
        $i = 0;
        foreach ($search as $column => $value) {
            $paramName = md5(uniqid());
            $query->andWhere('s.' . $column . ' LIKE ?' . ++$i);
            $query->setParameter($i, $value);
        }

        foreach ($sort as $column => $direction) {
            $query->add('orderBy', "s.$column $direction");
        }

        $query = $query->getQuery();

       return $query->getResult();
    }
}