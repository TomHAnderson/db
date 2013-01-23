<?php

namespace Geoname\Entity\Field;

trait Admin3Code
{
    protected $admin3Code;

    public function setAdmin3Code($admin3Code)
    {
        $this->admin3Code = $admin3Code;
        return $this;
    }

    public function getAdmin3Code()
    {
        return $this->admin3Code;
    }
}