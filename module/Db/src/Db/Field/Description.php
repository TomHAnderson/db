<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait Description
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "description"})
     * @Form\Options({"label": "Description"})
     */
    protected $description;

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($value)
    {
        $this->description = $value;
        return $this;
    }
}
