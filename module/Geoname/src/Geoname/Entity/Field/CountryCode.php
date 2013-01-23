<?php

namespace Geoname\Entity\Field;

trait CountryCode
{
    protected $countryCode;

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }
}