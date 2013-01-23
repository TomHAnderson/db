<?php

namespace Geoname\Entity\Field;

trait Iso3
{
    protected $iso3;

    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;
        return $this;
    }

    public function getIso3()
    {
        return $this->iso3;
    }
}