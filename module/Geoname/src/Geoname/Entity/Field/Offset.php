<?php

namespace Geoname\Entity\Field;

trait Offset
{
    protected $offset;

    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function getOffset()
    {
        return $this->offset;
    }
}