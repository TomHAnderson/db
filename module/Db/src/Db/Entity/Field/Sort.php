<?php
namespace Db\Entity\Field;

trait Sort
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "sort"})
     * @Form\Options({"label": "Sort"})
     */
    protected $sort;

    public function getSort()
    {
        return $this->sort;
    }

    public function setSort($value)
    {
        $this->sort = $value;
        return $this;
    }

    private function inputFilterInputSort($inputFilter = null) {
        if (!$inputFilter) $inputFilter = new InputFilter();

        return $inputFilter->getFactory()->createInput(array(
            'name' => 'sort',
            'required' => true,
            'validators' => array(
                array('name' => 'int'),
            ),
        ));
    }
}
