<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;
use Zend\InputFilter\InputFilter;

trait Username
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "username"})
     * @Form\Options({"label": "User Name"})
     */
    protected $username;

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($value)
    {
        $this->username = $value;
        return $this;
    }

    private function inputFilterInputUsername($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'username',
            'required' => true,
            'validators' => array(),
        ));
    }
}
