<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Venues
{
    protected $venues;

    public function getShows() {
        if (!$this->venues)
            $this->venues = new ArrayCollection();

        return $this->venues;
    }
}
