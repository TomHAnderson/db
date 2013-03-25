<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Value
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "value"})
     * @Form\Options({"label": "Value"})
     */
    protected $value;

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    private function inputFilterInputValue($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'value' => 'value',
            'required' => false,
            'validators' => array(),
        ));
    }
}
