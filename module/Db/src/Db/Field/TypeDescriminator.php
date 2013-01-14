<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait TypeDescriminator
{
    protected $typeDescriminator;

    public function getTypeDescriminator() {
        return $this->typeDescriminator;
    }

    public function setTypeDescriminator($value) {
        $this->typeDescriminator = $value;
        return $this;
    }
}
