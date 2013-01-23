<?php

namespace Geoname\Entity\Field;

trait Elevation
{
    protected $elevation;

    public function setElevation($elevation)
    {
        $this->elevation = $elevation;
        return $this;
    }

    public function getElevation()
    {
        return $this->elevation;
    }
}