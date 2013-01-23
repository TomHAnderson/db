<?php

namespace Geoname\Entity\Relation;
use Doctrine\Common\Collections\ArrayCollection
    , Geoname\Entity\Place
    ;

trait Places
{
    protected $places;

    public function getPlaces()
    {
        if (!$this->places)
            $this->places = new ArrayCollection();

        return $this->places;
    }

    public function addPlace(Place $place)
    {
        $this->places->add($place);
        return $this;
    }

    public function removePlace(Place $place)
    {
        $this->places->removeElement($place);
        return $this;
    }
}