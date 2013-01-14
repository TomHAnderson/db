<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait DiscCountShn
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "number"})
     * @Form\Attributes({"id": "discCountShn"})
     * @Form\Attributes({"min": "0"})
     * @Form\Attributes({"step": "1"})
     * @Form\Options({"label": "Disc Count SHN"})
     */
    protected $discCountShn;

    public function getDiscCountShn()
    {
        return $this->discCountShn;
    }

    public function setDiscCountShn($value)
    {
        $this->discCountShn = $value;
        return $this;
    }
}
