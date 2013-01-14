<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait NameNormalized
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "nameNormalized"})
     * @Form\Options({"label": "Name Normalized"})
     */
    protected $nameNormalized;

    public function getNameNormalized()
    {
        return $this->nameNormalized;
    }

    public function setNameNormalized($value)
    {
        $this->nameNormalized = $value;
        return $this;
    }
}
