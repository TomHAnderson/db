<?php

namespace Geoname\Entity\Relation;
use Doctrine\Common\Collections\ArrayCollection
    , Geoname\Entity\Country
    ;

trait Countries
{
    protected $countries;

    public function getCountries()
    {
        if (!$this->countries)
            $this->countries = new ArrayCollection();

        return $this->countries;
    }

    public function addCountrie(Country $country)
    {
        $this->countries->add($country);
        return $this;
    }

    public function removeCountrie(Country $country)
    {
        $this->countries->removeElement($country);
        return $this;
    }
}