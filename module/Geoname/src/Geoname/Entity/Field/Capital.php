<?php

namespace Geoname\Entity\Field;

trait Capital
{
    protected $capital;

    public function setCapital($capital)
    {
        $this->capital = $capital;
        return $this;
    }

    public function getCapital()
    {
        return $this->capital;
    }
}