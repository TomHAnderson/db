<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    ;

trait DisplayName
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "displayName"})
     * @Form\Options({"label": "Display Name"})
     */
    protected $displayName;

    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function setDisplayName($value)
    {
        $this->displayName = $value;
        return $this;
    }

    private function inputFilterInputDisplayName(InputFilter $inputFilter) {
        return $inputFilter->getFactory()->createInput(array(
            'name' => 'displayName',
            'required' => true,
            'validators' => array(),
        ));
    }
}
