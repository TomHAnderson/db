<?php

namespace Geoname\Entity\Field;

trait Abbrev
{
    protected $abbrev;

    public function setAbbrev($abbrev)
    {
        $this->abbrev = $abbrev;
        return $this;
    }

    public function getAbbrev()
    {
        return $this->abbrev;
    }
}