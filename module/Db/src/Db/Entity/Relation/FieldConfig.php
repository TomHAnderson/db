<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait FieldConfig
{
    protected $fieldConfig;

    public function getFieldConfig()
    {
        if (!$this->fieldConfig)
            $this->fieldConfig = new ArrayCollection();

        return $this->fieldConfig;
    }
}
