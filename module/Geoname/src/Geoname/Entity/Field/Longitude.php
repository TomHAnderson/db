<?php

namespace Geoname\Entity\Field;

trait Longitude
{
    protected $longitude;

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }
}