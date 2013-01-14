<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait Set3
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "set3"})
     * @Form\Options({"label": "Set 3"})
     */
    protected $set3;

    public function getSet3() {
        return $this->set3;
    }

    public function setSet3($value) {
        $this->set3 = $value;
        return $this;
    }
}
