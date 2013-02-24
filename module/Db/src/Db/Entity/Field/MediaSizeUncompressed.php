<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait MediaSizeUncompressed
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "number"})
     * @Form\Attributes({"id": "mediaSizeUncompressed"})
     * @Form\Attributes({"min": "0"})
     * @Form\Attributes({"step": "1000"})
     * @Form\Options({"label": "Media Size Uncompressed"})
     */
    protected $mediaSizeUncompressed;

    public function getMediaSizeUncompressed()
    {
        return $this->mediaSizeUncompressed;
    }

    public function setMediaSizeUncompressed($value)
    {
        $this->mediaSizeUncompressed = $value;
        return $this;
    }

    private function inputFilterInputMediaSizeUncompressed($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'mediaSizeUncompressed',
            'required' => false,
            'validators' => array(
                array(
                    'name' => 'int',
                )
            ),
        ));
    }
}
