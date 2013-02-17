<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Lastname
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "lastname"})
     * @Form\Options({"label": "Lastname"})
     */
    protected $lastname;

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($value)
    {
        $this->lastname = $value;

        if (method_exists($this, 'setLastnameNormalize'))
            $this->setLastnameNormalize($this->getLastname());

        return $this;
    }

    private function inputFilterInputLastname($inputFilter = null) {
        return $inputFilter->getFactory()->createInput(array(
            'name' => 'lastname',
            'required' => false,
            'validators' => array(),
        ));
    }
}
