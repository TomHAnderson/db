<?php
namespace Db\Entity\Field;

trait City
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "city"})
     * @Form\Options({"label": "City"})
     */
    protected $city;

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($value)
    {
        $this->city = $value;
        return $this;
    }

    private function inputFilterInputCity($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'city',
            'required' => false,
            'validators' => array(),
        ));
    }
}
