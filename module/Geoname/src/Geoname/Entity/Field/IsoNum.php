<?php

namespace Geoname\Entity\Field;

trait IsoNum
{
    protected $isoNum;

    public function setIsoNum($isoNum)
    {
        $this->isoNum = $isoNum;
        return $this;
    }

    public function getIsoNum()
    {
        return $this->isoNum;
    }
}