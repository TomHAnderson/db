<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait IsSegue
{
    /**
     * @Form\Type("Zend\Form\Element\Radio")
     * @Form\Attributes({"type": "radio"})
     * @Form\Attributes({"id": "isSegue"})
     * @Form\Attributes({"is_required": true})
     * @Form\Options({"label": "Public?", "value_options": {"1": "Yes", "0": "No"}})
     */
    protected $isSegue;

    public function getIsSegue()
    {
        return $this->isSegue;
    }

    public function setIsSegue($value)
    {
        $this->isSegue = $value;
        return $this;
    }

    private function inputFilterInputIsSegue($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'isSegue',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'digits'
                ),
            ),
        ));
    }
}
