<?php

namespace Geoname\Entity\Field;

trait Iso2
{
    protected $iso2;

    public function setIso2($iso2)
    {
        $this->iso2 = $iso2;
        return $this;
    }

    public function getIso2()
    {
        return $this->iso2;
    }
}