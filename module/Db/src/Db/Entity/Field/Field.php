<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Field
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "field"})
     * @Form\Options({"label": "Field"})
     */
    protected $field;

    public function getField()
    {
        return $this->field;
    }

    public function setField($value)
    {
        $this->field = $value;

        return $this;
    }

    private function inputFilterInputField($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'field' => 'field',
            'required' => true,
            'validators' => array(),
        ));
    }
}
