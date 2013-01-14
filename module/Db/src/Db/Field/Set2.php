<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait Set2
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "set2"})
     * @Form\Options({"label": "Set 2"})
     */
    protected $set2;

    public function getSet2() {
        return $this->set2;
    }

    public function setSet2($value) {
        $this->set2 = $value;
        return $this;
    }
}
