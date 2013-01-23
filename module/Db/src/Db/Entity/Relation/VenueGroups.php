<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait VenueGroups
{
    protected $venueGroups;

    public function getVenueGroups() {
        if (!$this->venueGroups)
            $this->venueGroups = new ArrayCollection();

        return $this->venueGroups;
    }
}
