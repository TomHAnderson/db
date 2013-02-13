<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    ;

trait IsPublic
{
    /**
     * @Form\Type("Zend\Form\Element\Radio")
     * @Form\Attributes({"type": "radio"})
     * @Form\Attributes({"id": "isPublic"})
     * @Form\Attributes({"is_required": true})
     * @Form\Options({"label": "Public?", "value_options": {"1": "Yes", "0": "No"}})
     */
    protected $isPublic;

    public function getIsPublic()
    {
        return $this->isPublic;
    }

    public function setIsPublic($value)
    {
        $this->isPublic = $value;
        return $this;
    }

    private function inputFilterInputIsPublic(InputFilter $inputFilter)
    {
        return $inputFilter->getFactory()->createInput(array(
            'name' => 'isPublic',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'digits'
                ),
            ),
        ));
    }
}
