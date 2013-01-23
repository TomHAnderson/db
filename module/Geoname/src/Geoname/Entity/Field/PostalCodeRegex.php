<?php

namespace Geoname\Entity\Field;

trait PostalCodeRegex
{
    protected $postalCodeRegex;

    public function setPostalCodeRegex($postalCodeRegex)
    {
        $this->postalCodeRegex = $postalCodeRegex;
        return $this;
    }

    public function getPostalCodeRegex()
    {
        return $this->postalCodeRegex;
    }
}