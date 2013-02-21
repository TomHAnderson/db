<?php
namespace Db\Entity\Field;

use Db\Entity\Zipcode as ZipcodeEntity;

trait Zipcode
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "zipcode"})
     * @Form\Options({"label": "Zipcode"})
     */
    protected $zipcode;

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setZipcode(ZipcodeEntity $value)
    {
        $this->zipcode = $value;
        return $this;
    }

    private function inputFilterInputZipcode($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'zipcode',
            'required' => false,
            'validators' => array(),
        ));
    }
}
