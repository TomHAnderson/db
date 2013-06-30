<?php

namespace Db\Filter;

use Traversable;
use Zend\Filter\AbstractFilter;

class DoctrineEntity extends AbstractFilter
{
    /**
     * @var array
     */
    protected $entityClass;

    /**
     * Constructor
     *
     * @param string $entityClass
     */
    public function __construct($entityClass)
    {
        $this->setEntityClass($entityClass);
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }

    public function setEntityClass($value)
    {
        $this->entityClass = $value;
        return $this;
    }

    /**
     * Defined by Zend\Filter\FilterInterface
     */
    public function filter($value)
    {
        if (!$value) return null;

        return \Db\Module::getEntityManager()->getRepository($this->getEntityClass())->find($value);
    }
}
