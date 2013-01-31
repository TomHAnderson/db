<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Rating
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "integer"})
     * @Form\Attributes({"id": "rating"})
     * @Form\Options({"label": "Rating"})
     */
    protected $rating;

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($value)
    {
        $this->rating = $value;
        return $this;
    }

    private function inputFilterInputRating($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'rating',
            'required' => false,
            'validators' => array(
                array('name' => 'Int')
            ),
        ));
    }
}
