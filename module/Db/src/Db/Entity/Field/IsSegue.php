<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait IsSegue
{
    /**
     * @Form\Type("Zend\Form\Element\Radio")
     * @Form\Attributes({"type": "checkbox"})
     * @Form\Attributes({"id": "isSegue"})
     * @Form\Options({"label": "Segue Out?"})
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
            'required' => false,
            'validators' => array(
                array(
                    'name' => 'digits'
                ),
            ),
        ));
    }
}
