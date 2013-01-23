<?php

namespace Geoname\Entity\Field;
use Geoname\Entity\Place as PlaceEntity;

trait Continent
{
    protected $continent;

    public function setContinent(CurrencyEntityPlaceEntity $continent)
    {
        $this->continent = $continent;
        return $this;
    }

    public function getContinent()
    {
        return $this->continent;
    }
}