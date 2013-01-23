<?php

namespace Geoname\Entity\Field;

trait Phone
{
    protected $phone;

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }
}