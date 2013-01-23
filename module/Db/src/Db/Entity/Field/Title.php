<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Title
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "title"})
     * @Form\Options({"label": "Title"})
     */
    protected $title;

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($value) {
        $this->title = $value;
        return $this;
    }
}
