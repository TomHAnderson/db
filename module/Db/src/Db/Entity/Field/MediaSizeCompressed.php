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
     * @Form\Attributes({"step": "1"})
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
}
