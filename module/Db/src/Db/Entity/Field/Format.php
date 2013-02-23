<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Format
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "format"})
     * @Form\Options({"label": "Format"})
     */
    protected $format;

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($value)
    {
        $this->format = $value;

        if (method_exists($this, 'setFormatNormalize'))
            $this->setFormatNormalize($this->getFormat());

        return $this;
    }

    private function inputFilterInputFormat($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'format',
            'required' => true,
            'validators' => array(),
        ));
    }
}
