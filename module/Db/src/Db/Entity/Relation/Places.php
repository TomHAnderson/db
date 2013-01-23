<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Places
{
    protected $places;

    public function getPlaces() {
        if (!$this->places)
            $this->places = new ArrayCollection();

        return $this->places;
    }
}
