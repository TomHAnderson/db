<?php

namespace Geoname\Entity\Field;

trait IsShort
{
    protected $isShort;

    public function setIsShort($isShort)
    {
        $this->isShort = $isShort;
        return $this;
    }

    public function getIsShort()
    {
        return $this->isShort;
    }
}
