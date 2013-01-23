<?php

namespace Geoname\Entity\Field;

trait IsLocked
{
    protected $isLocked;

    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;
        return $this;
    }

    public function getIsLocked()
    {
        return $this->isLocked;
    }
}