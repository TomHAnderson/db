<?php

namespace Geoname\Entity\Field;

trait Latitude
{
    protected $latitude;

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }
}