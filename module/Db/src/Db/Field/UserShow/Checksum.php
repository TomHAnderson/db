<?php

namespace Db\Field\UserShow;
use Zend\Form\Annotation as Form;

trait Checksum
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "checksum"})
     * @Form\Options({"label": "Source Note"})
     */
    protected $checksum;

    public function getChecksum() {
        return $this->checksum;
    }

    public function setChecksum($value) {
        $this->checksum = $value;
        return $this;
    }
}
