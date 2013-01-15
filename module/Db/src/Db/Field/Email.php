<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait Email
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "email"})
     * @Form\Options({"label": "Email"})
     */
    protected $email;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->email = $value;
        return $this;
    }

    private function inputFilterInputEmail($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'email',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                ),
            ),
        ));
    }
}
