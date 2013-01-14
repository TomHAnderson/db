<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Cities
{
    protected $cities;

    public function getCities() {
        if (!$this->cities)
            $this->cities = new ArrayCollection();

        return $this->cities;
    }
}
