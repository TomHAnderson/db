<?php

namespace Geoname\Entity\Field;
use \Geoname\Entity\Place as PlaceEntity;

trait Place
{
    protected $place;

    public function setPlace(PlaceEntity $place)
    {
        $this->place = $place;
        return $this;
    }

    public function getPlace()
    {
        return $this->place;
    }
}