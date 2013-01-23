<?php

namespace Geoname\Entity\Field;

trait Status
{
    protected $status;

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }
}