<?php
namespace Db\Entity\Field;

trait State
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "state"})
     * @Form\Options({"label": "State"})
     */
    protected $state;

    public function getState()
    {
        return $this->state;
    }

    public function setState($value)
    {
        $this->state = $value;
        return $this;
    }

    private function inputFilterInputState($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'state',
            'required' => false,
            'validators' => array(),
        ));
    }
}
