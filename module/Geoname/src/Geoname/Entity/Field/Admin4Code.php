<?php

namespace Geoname\Entity\Field;

trait Admin4Code
{
    protected $admin4Code;

    public function setAdmin4Code($admin4Code)
    {
        $this->admin4Code = $admin4Code;
        return $this;
    }

    public function getAdmin4Code()
    {
        return $this->admin4Code;
    }
}