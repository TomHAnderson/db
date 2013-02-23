<?php
namespace Db\Entity\Field;

trait Sort
{
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
            'required' => false,
            'validators' => array(
                array('name' => 'int'),
            ),
        ));
    }
}
