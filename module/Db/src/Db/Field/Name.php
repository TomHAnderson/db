<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait Name
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "name"})
     * @Form\Options({"label": "Name"})
     */
    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }

    private function inputFilterInputName($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'name',
            'required' => true,
            'validators' => array(),
        ));
    }
}
