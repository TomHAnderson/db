<?php

namespace Geoname\Entity\Field;

trait OffsetJan
{
    protected $offsetJan;

    public function setOffsetJan($offsetJan)
    {
        $this->offsetJan = $offsetJan;
        return $this;
    }

    public function getOffsetJan()
    {
        return $this->offsetJan;
    }
}