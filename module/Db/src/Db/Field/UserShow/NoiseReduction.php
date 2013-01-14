<?php

namespace Db\Field\UserShow;
use Zend\Form\Annotation as Form;

trait NoiseReduction
{
    /**
     * @Form\Type("Zend\Form\Element\Radio")
     * @Form\Attributes({"type": "radio"})
     * @Form\Attributes({"id": "noiseReduction"})
     * @Form\Attributes({"is_required": true})
     * @Form\Options({"label": "Was Noise Reduction Used?", "value_options": {"1": "Yes", "0": "No"}})
     */
    protected $noiseReduction;

    public function getNoiseReduction()
    {
        return $this->noiseReduction;
    }

    public function setNoiseReduction($value)
    {
        $this->noiseReduction = $value;
        return $this;
    }
}
