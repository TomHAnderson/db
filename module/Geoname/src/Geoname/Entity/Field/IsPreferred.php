<?php

namespace Geoname\Entity\Field;

trait IsPreferred
{
    protected $isPreferred;

    public function setIsPreferred($isPreferred)
    {
        $this->isPreferred = $isPreferred;
        return $this;
    }

    public function getIsPreferred()
    {
        return $this->isPreferred;
    }
}