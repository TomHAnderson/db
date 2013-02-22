<?php
/**
 * Music Brains ID
 */

namespace Db\Entity\Field;

trait Mbid
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "mbid"})
     * @Form\Options({"label": "Music Brains ID"})
     * @Form\Attributes({"pattern": "[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}"})
     * @Form\Attributes({"data-validation-pattern-message": "Invalid Music Brains ID"})
     * @Form\Attributes({"placeholder": ""})
     */
    protected $mbid;

    public function getMbid()
    {
        return $this->mbid;
    }

    public function setMbid($value)
    {
        $this->mbid = $value;
        return $this;
    }

    private function inputFilterInputMbid($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'mbid',
            'required' => false,
            'validators' => array(),
        ));
    }
}
