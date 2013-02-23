<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    ;

trait Length
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "length"})
     * @Form\Options({"label": "Length"})
     */
    protected $length;

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($value)
    {
        $this->length = $value;
        return $this;
    }

    private function inputFilterInputLength($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'length',
            'required' => false,
            'validators' => array(),
        ));
    }
}
