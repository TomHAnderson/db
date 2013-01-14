<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait Note
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "note"})
     * @Form\Options({"label": "Note"})
     */
    protected $note;

    public function getNote() {
        return $this->note;
    }

    public function setNote($value) {
        $this->note = $value;
        return $this;
    }
}
