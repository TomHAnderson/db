<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait CirculatedAt
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "text"})
     * @Form\Attributes({"id": "circulatedAt"})
     * @Form\Options({"label": "Date Circulated"})
     */
    protected $circulatedAt;

    public function getCirculatedAt()
    {
        return $this->circulatedAt;
    }

    public function setCirculatedAt($value)
    {
        $this->circulatedAt = $value;
        return $this;
    }

    private function inputFilterInputCirculatedAt($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'circulatedAt',
            'required' => false,
            'validators' => array(),
        ));
    }
}
