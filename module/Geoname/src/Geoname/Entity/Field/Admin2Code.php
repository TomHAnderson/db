<?php

namespace Geoname\Entity\Field;

trait Admin2Code
{
    protected $admin2Code;

    public function setAdmin2Code($admin2Code)
    {
        $this->admin2Code = $admin2Code;
        return $this;
    }

    public function getAdmin2Code()
    {
        return $this->admin2Code;
    }
}