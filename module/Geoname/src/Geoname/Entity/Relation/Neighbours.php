<?php

namespace Geoname\Entity\Relation;
use Doctrine\Common\Collections\ArrayCollection
    , Geoname\Entity\Country as Neighbour
    ;

trait Neighbours
{
    protected $neighbours;

    public function getNeighbours()
    {
        if (!$this->neighbours)
            $this->neighbours = new ArrayCollection();

        return $this->neighbours;
    }

    public function addNeighbour(Neighbour $neighbour)
    {
        $this->neighbours->add($neighbour);
        return $this;
    }

    public function removeNeighbour(Neighbour $neighbour)
    {
        $this->neighbours->removeElement($neighbour);
        return $this;
    }
}