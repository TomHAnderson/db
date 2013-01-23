<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait IsEncore
{
    /**
     * @Form\Type("Zend\Form\Element\Radio")
     * @Form\Attributes({"type": "radio"})
     * @Form\Attributes({"id": "isEncore"})
     * @Form\Attributes({"is_required": true})
     * @Form\Options({"label": "Public?", "value_options": {"1": "Yes", "0": "No"}})
     */
    protected $isEncore;

    public function getIsEncore()
    {
        return $this->isEncore;
    }

    public function setIsEncore($value)
    {
        $this->isEncore = $value;
        return $this;
    }

    private function inputFilterInputIsEncore($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'isEncore',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'digits'
                ),
            ),
        ));
    }
}
