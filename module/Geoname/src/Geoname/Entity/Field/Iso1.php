<?php

namespace Geoname\Entity\Field;

trait Iso1
{
    protected $iso1;

    public function setIso1($iso1)
    {
        $this->iso1 = $iso1;
        return $this;
    }

    public function getIso1()
    {
        return $this->iso1;
    }
}