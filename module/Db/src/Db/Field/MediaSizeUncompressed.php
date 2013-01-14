<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait MediaSizeUncompressed
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "number"})
     * @Form\Attributes({"id": "mediaSizeUncompressed"})
     * @Form\Attributes({"min": "0"})
     * @Form\Attributes({"step": "1"})
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
}
