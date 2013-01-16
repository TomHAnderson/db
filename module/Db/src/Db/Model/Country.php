<?php

namespace Db\Model;

use Db\Model\AbstractEntityModel;
use Zend\InputFilter\InputFilter;

final class Country extends AbstractEntityModel
{
    use \Db\Field\Name
        , \Db\Field\Abbrev
        ;

    public function getDefaultSort()
    {
        return array('name' => 'asc');
    }

    public function getInputFilter($entity = null)
    {
        $inputFilter = new InputFilter();
        $inputFilter->add($this->inputFilterInputName($inputFilter));
        $inputFilter->add($this->inputFilterInputAbbrev($inputFilter));

        return $inputFilter;
    }
}