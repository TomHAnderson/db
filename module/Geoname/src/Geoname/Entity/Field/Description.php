<?php

namespace Geoname\Entity\Field;

trait Description
{
    protected $description;

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }
}