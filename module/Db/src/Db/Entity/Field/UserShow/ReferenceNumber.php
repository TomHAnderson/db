<?php

namespace Db\Entity\Field\UserShow;
use Zend\Form\Annotation as Form;

trait ReferenceNumber
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "referenceNumber"})
     * @Form\Options({"label": "Reference Number"})
     */
    protected $referenceNumber;

    public function getReferenceNumber() {
        return $this->referenceNumber;
    }

    public function setReferenceNumber($value) {
        $this->referenceNumber = $value;
        return $this;
    }
}
