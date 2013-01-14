<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Zipcodes
{
    protected $zipcodes;

    public function getZipcodes()
    {
        if (!$this->zipcodes)
            $this->zipcodes = new ArrayCollection();

        return $this->zipcodes;
    }
}
