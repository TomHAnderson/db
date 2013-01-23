<?php

namespace Geoname\Entity\Relation;
use Doctrine\Common\Collections\ArrayCollection
    ;

trait AltNames
{
    protected $altNames;

    public function getAltNames()
    {
        if (!$this->altNames)
            $this->altNames = new ArrayCollection();

        return $this->altNames;
    }

    public function addAltName(AltName $altName)
    {
        $this->altNames->add($altName);
        return $this;
    }

    public function removeChild(altName $altName)
    {
        $this->altNames->removeElement($altName);
        return $this;
    }
}