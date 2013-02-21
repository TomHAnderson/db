<?php
namespace Db\Entity\Field;

trait Country
{
    /**
     * @Form\Type("Zend\Form\Element\Select")
     * @Form\Attributes({"id": "country"})
     * @Form\Options({"label": "Country"})
     * @Form\Attributes({"options": {"UNK": "Unknown"}})
     */
    protected $country;

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($value)
    {
        $this->country = $value;
        return $this;
    }

    private function inputFilterInputCountry($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'country',
            'required' => false,
            'validators' => array(),
        ));
    }
}
