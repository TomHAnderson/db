<?php

namespace Db\Model;
use Db\Model\AbstractEntityModel
    , Zend\InputFilter\InputFilter
    ;

final class State extends AbstractEntityModel
{
    use \Db\Entity\Field\Name
        , \Db\Entity\Field\Abbrev
        , \Db\Entity\Field\Country
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