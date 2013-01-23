<?php

namespace Geoname\Entity\Field;

trait Admin1Code
{
    protected $admin1Code;

    public function setAdmin1Code($admin1Code)
    {
        $this->admin1Code = $admin1Code;
        return $this;
    }

    public function getAdmin1Code()
    {
        return $this->admin1Code;
    }
}