<?php

namespace Db\Entity\Field\UserShow;
use Zend\Form\Annotation as Form;

trait Generation
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "number"})
     * @Form\Attributes({"id": "generation"})
     * @Form\Attributes({"min": "0"})
     * @Form\Attributes({"step": "1"})
     * @Form\Options({"label": "Generation"})
     */

    protected $generation;

    public function getGeneration() {
        return $this->generation;
    }

    public function setGeneration($value) {
        $this->generation = $value;
        return $this;
    }
}
