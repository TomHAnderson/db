<?php

namespace Db\Model\Component;

trait Entity
{
    use EntityManager;

    abstract function getDefaultSort();

    public function getEntityClass() {
        return str_replace('\\Model\\', '\\Entity\\', get_class($this));
    }

    public function find($id)
    {
        return $this->getEntityManager()->getRepository($this->getEntityClass())->find($id);
    }

    public function findOneBy($params)
    {
        return $this->getEntityManager()->getRepository($this->getEntityClass())->findOneBy($params);
    }

    public function findAll($sort = null)
    {
        if (!$sort) $sort = $this->getDefaultSort();
        return $this->getEntityManager()->getRepository($this->getEntityClass())->findBy(array(), $sort);
    }

    public function findBy($search, $sort = null)
    {
        if (!$sort) $sort = $this->getDefaultSort();
        return $this->getEntityManager()->getRepository($this->getEntityClass())->findBy($search, $sort);
    }

    public function findLike($search, $sort = null)
    {
        if (!$sort) $sort = $this->getDefaultSort();

        $query = $this->getEntityManager()->getRepository($this->getEntityClass())->createQueryBuilder('s');
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

    public function create($entity)
    {
        if (get_class($entity) !== $this->getEntityClass())
            throw new \Exception('Entity must be of type ' . $this->getEntityClass());

        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(__FUNCTION__, $this, array('entity' => $entity));

        return $entity;
    }

    public function edit($entity)
    {
        if (get_class($entity) !== $this->getEntityClass())
            throw new \Exception('Entity must be of type ' . $this->getEntityClass());

        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(__FUNCTION__, $this, array('entity' => $entity));

        return $entity;
    }

    public function delete($entity)
    {
        if (get_class($entity) !== $this->getEntityClass())
            throw new \Exception('Entity must be of type ' . $this->getEntityClass());

        $this->getEventManager()->trigger(__FUNCTION__, $this, array('entity' => $entity));
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }
}