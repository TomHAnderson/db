<?php

namespace Geoname\Entity\Field;

trait IsDeprecated
{
    protected $isDeprecated;

    public function setIsDeprecated($isDeprecated)
    {
        $this->isDeprecated = $isDeprecated;
        return $this;
    }

    public function getIsDeprecated()
    {
        return $this->isDeprecated;
    }
}