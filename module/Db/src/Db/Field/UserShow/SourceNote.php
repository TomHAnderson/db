<?php

namespace Db\Field\UserShow;
use Zend\Form\Annotation as Form;

trait SourceNote
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "textarea"})
     * @Form\Attributes({"id": "sourceNote"})
     * @Form\Options({"label": "Source Note"})
     */
    protected $sourceNote;

    public function getSourceNote() {
        return $this->sourceNote;
    }

    public function setSourceNote($value) {
        $this->sourceNote = $value;
        return $this;
    }
}
