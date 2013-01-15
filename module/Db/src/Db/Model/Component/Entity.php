<?php

namespace Db\Model\Component;

trait Entity
{
    use EntityManager;

    abstract function getEntityName();

    abstract function getDefaultSort();

    public function find($id)
    {
        return $this->getEntityManager()->getRepository($this->getEntityName())->find($id);
    }

    public function findOneBy($params)
    {
        return $this->getEntityManager()->getRepository($this->getEntityName())->findOneBy($params);
    }

    public function findAll($sort = null)
    {
        if (!$sort) $sort = $this->getDefaultSort();
        return $this->getEntityManager()->getRepository($this->getEntityName())->findBy(array(), $sort);
    }

    public function findBy($search, $sort = null)
    {
        if (!$sort) $sort = $this->getDefaultSort();
        return $this->getEntityManager()->getRepository($this->getEntityName())->findBy($search, $sort);
    }

    public function findLike($search, $sort = null)
    {
        if (!$sort) $sort = $this->getDefaultSort();

        $query = $this->getEntityManager()->getRepository($this->getEntityName())->createQueryBuilder('s');
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