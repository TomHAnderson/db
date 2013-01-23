<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait DiscCountWav
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "number"})
     * @Form\Attributes({"id": "discCountWav"})
     * @Form\Attributes({"min": "0"})
     * @Form\Attributes({"step": "1"})
     * @Form\Options({"label": "Disc Count WAV"})
     */
    protected $discCountWav;

    public function getDiscCountWav()
    {
        return $this->discCountWav;
    }

    public function setDiscCountWav($value)
    {
        $this->discCountWav = $value;
        return $this;
    }
}
