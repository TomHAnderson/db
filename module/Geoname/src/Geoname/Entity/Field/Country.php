<?php

namespace Geoname\Entity\Field;
use Geoname\Entity\Country as CountryEntity;

trait Country
{
    protected $country;

    public function setCountry(CountryEntity $country)
    {
        $this->country = $country;
        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }
}