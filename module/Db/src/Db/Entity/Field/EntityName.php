<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait EntityName
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "entityName"})
     * @Form\Options({"label": "EntityName"})
     */
    protected $entityName;

    public function getEntityName()
    {
        return $this->entityName;
    }

    public function setEntityName($value)
    {
        $this->entityName = $value;

        return $this;
    }

    private function inputFilterInputEntityName($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'entityName' => 'entityName',
            'required' => true,
            'validators' => array(),
        ));
    }
}
