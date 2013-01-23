<?php

namespace Geoname\Entity\Field;

trait OffsetJul
{
    protected $offsetJul;

    public function setOffsetJul($offsetJul)
    {
        $this->offsetJul = $offsetJul;
        return $this;
    }

    public function getOffsetJul()
    {
        return $this->offsetJul;
    }
}