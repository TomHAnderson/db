<?php

namespace Db\Form\Element;

use Zend\Form\Element\Text;

class Lookup extends Text
{
    protected $entity = null;

    protected $entityClass = '';

    public function setOptions($options)
    {
        parent::setOptions($options);

        if (isset($this->options['entity_class'])) {
            $this->setEntityClass($this->options['entity_class']);
        }

        return $this;
    }

    /**
     * Set the element value
     *
     * @param  mixed $value
     * @return Element
     */
    public function setValue($value)
    {
        $entityClass = $this->getEntityClass();
        if ($value instanceof $entityClass) {
            $this->setEntity($value);
            $this->value = $value->getId();
        } else {
            if ($this->value) $this->setEntity(\Db\Module::getEntityManager()->getRepository($this->getEntityClass())->find($value));
            $this->value = $value;
        }

        return $this;
    }

    /**
     * Retrieve the element value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function setEntity($value)
    {
        $entityClass = $this->entityClass;
        if ( ! $value instanceof $entityClass) {
            throw new \Exception('Invalid entity class.  Expected ' . $entityClass . ' got ' . get_class($value));
        }

        $this->entity = $value;
        return $this;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function getEntityClass()
    {
        return $this->entityClass;
    }

    public function setEntityClass($className)
    {
        $this->entityClass = $className;
        return $this;
    }
}