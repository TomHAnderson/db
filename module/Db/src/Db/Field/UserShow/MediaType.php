<?php

namespace Db\Field\UserShow;
use Zend\Form\Annotation as Form;

trait MediaType
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "number"})
     * @Form\Attributes({"id": "mediaType"})
     * @Form\Attributes({"min": "0"})
     * @Form\Attributes({"step": "1"})
     * @Form\Options({"label": "Media Type"})
     */

    protected $mediaType;

    public function getMediaType() {
        return $this->mediaType;
    }

    public function setMediaType($value) {
        $this->mediaType = $value;
        return $this;
    }
}
