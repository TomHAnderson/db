<?php
namespace Db\Entity\Field;

trait Sort
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "number"})
     * @Form\Attributes({"id": "sort"})
     * @Form\Options({"label": "Sort"})
     * @Form\Attributes({"required": "required"})
     */
    protected $sort = 9999;

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
            'required' => false,
            'validators' => array(
                array('name' => 'int'),
            ),
        ));
    }
}
