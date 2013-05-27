<?php

namespace Db\Repository;

use Db\Model\AbstractModel;
use Zend\InputFilter\InputFilter;
use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

abstract class AbstractRepository extends EntityRepository
{
    public function findLike($search, $sort = array(), $limit = 0, $offset = 0)
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

        if ($limit) $query->setMaxResults($limit);

        if ($offset) $query->setFirstResult($offset);

        $query = $query->getQuery();

       return $query->getResult();
    }
}