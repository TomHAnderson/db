<?php

namespace Geoname\Entity\Field;

trait Code
{
    protected $code;

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }
}