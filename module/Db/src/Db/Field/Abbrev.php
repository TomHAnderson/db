<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait Abbrev
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "abbrev"})
     * @Form\Options({"label": "Abbrev"})
     */
    protected $abbrev;

    public function getAbbrev()
    {
        return $this->abbrev;
    }

    public function setAbbrev($value)
    {
        $this->abbrev = $value;
        return $this;
    }
}
