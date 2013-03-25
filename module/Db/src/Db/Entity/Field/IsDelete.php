<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
    ;

trait IsDelete
{
    /**
     * @Form\Type("Zend\Form\Element\Radio")
     * @Form\Attributes({"type": "radio"})
     * @Form\Attributes({"id": "isDelete"})
     * @Form\Attributes({"is_required": true})
     * @Form\Options({"label": "Delete?", "value_options": {"1": "Yes", "0": "No"}})
     */
    protected $isDelete;

    public function getIsDelete()
    {
        return $this->isDelete;
    }

    public function setIsDelete($value)
    {
        $this->isDelete = $value;
        return $this;
    }

    private function inputFilterInputIsDelete(InputFilter $inputFilter)
    {
        return $inputFilter->getFactory()->createInput(array(
            'name' => 'isDelete',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'digits'
                ),
            ),
        ));
    }
}
