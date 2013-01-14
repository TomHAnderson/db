<?php

namespace Db\Field\UserShow;
use Zend\Form\Annotation as Form;

trait Microphone
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "microphone"})
     * @Form\Options({"label": "Microphone Notes"})
     */
    protected $microphone;

    public function getMicrophone() {
        return $this->microphone;
    }

    public function setMicrophone($value) {
        $this->microphone = $value;
        return $this;
    }
}
