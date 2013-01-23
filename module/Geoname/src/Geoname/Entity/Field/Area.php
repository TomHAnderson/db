<?php

namespace Geoname\Entity\Field;

trait Area
{
    protected $area;

    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }

    public function getArea()
    {
        return $this->area;
    }
}