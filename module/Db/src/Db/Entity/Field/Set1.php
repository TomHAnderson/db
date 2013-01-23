<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Set1
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "set1"})
     * @Form\Options({"label": "Set 1"})
     */
    protected $set1;

    public function getSet1() {
        return $this->set1;
    }

    public function setSet1($value) {
        $this->set1 = $value;
        return $this;
    }
}
