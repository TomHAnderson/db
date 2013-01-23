<?php

namespace Db\Entity\Field\UserShow;
use Zend\Form\Annotation as Form;

trait MediaCount
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "number"})
     * @Form\Attributes({"id": "mediaCount"})
     * @Form\Attributes({"min": "0"})
     * @Form\Attributes({"step": "1"})
     * @Form\Options({"label": "Media Count"})
     */

    protected $mediaCount;

    public function getMediaCount() {
        return $this->mediaCount;
    }

    public function setMediaCount($value) {
        $this->mediaCount = $value;
        return $this;
    }
}
