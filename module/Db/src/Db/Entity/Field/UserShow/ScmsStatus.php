<?php

namespace Db\Entity\Field\UserShow;
use Zend\Form\Annotation as Form;

trait ScmsStatus
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "scmsStatus"})
     * @Form\Options({"label": "SCMS Status"})
     */
    protected $scmsStatus;

    public function getScmsStatus() {
        return $this->scmsStatus;
    }

    public function setScmsStatus($value) {
        $this->scmsStatus = $value;
        return $this;
    }
}
