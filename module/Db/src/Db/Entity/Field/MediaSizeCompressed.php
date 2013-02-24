<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait MediaSizeCompressed
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "number"})
     * @Form\Attributes({"id": "mediaSizeCompressed"})
     * @Form\Attributes({"min": "0"})
     * @Form\Attributes({"step": "100"})
     * @Form\Options({"label": "Media Size Compressed"})
     */
    protected $mediaSizeCompressed;

    public function getMediaSizeCompressed()
    {
        return $this->mediaSizeCompressed;
    }

    public function setMediaSizeCompressed($value) {
        $this->mediaSizeCompressed = $value;
        return $this;
    }

    private function inputFilterInputMediaSizeCompressed($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'mediaSizeCompressed',
            'required' => false,
            'validators' => array(),
        ));
    }
}
