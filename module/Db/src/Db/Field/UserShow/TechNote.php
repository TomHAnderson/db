<?php

namespace Db\Field\UserShow;
use Zend\Form\Annotation as Form;

trait TechNote
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "techNote"})
     * @Form\Options({"label": "Technical Notes"})
     */
    protected $techNote;

    public function getTechNote() {
        return $this->techNote;
    }

    public function setTechNote($value) {
        $this->techNote = $value;
        return $this;
    }
}
