<?php

namespace Geoname\Entity\Field;

trait Population
{
    protected $population;

    public function setPopulation($population)
    {
        $this->population = $population;
        return $this;
    }

    public function getPopulation()
    {
        return $this->population;
    }
}