<?php

namespace Geoname\Entity\Field;

trait PostalCode
{
    protected $postalCode;

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }
}