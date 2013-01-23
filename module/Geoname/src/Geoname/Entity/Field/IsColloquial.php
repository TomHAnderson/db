<?php

namespace Geoname\Entity\Field;

trait IsColloquial
{
    protected $isColloquial;

    public function setIsColloquial($isColloquial)
    {
        $this->isColloquial = $isColloquial;
        return $this;
    }

    public function getIsColloquial()
    {
        return $this->isColloquial;
    }
}