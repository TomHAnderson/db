<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait EntityId
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "integer"})
     * @Form\Attributes({"id": "entityId"})
     * @Form\Options({"label": "EntityId"})
     */
    protected $entityId;

    public function getEntityId()
    {
        return $this->entityId;
    }

    public function setEntityId($value)
    {
        $this->entityId = $value;
        return $this;
    }

    private function inputFilterInputEntityId($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'entityId',
            'required' => true,
            'validators' => array(
                array('name' => 'Int')
            ),
        ));
    }
}
