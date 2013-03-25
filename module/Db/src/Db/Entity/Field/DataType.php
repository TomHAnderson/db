<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait DataType
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "dataType"})
     * @Form\Options({"label": "DataType"})
     */
    protected $dataType;

    public function getDataType()
    {
        return $this->dataType;
    }

    public function setDataType($value)
    {
        $this->dataType = $value;

        return $this;
    }

    private function inputFilterInputDataType($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'dataType' => 'dataType',
            'required' => true,
            'validators' => array(),
        ));
    }
}
