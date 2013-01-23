<?php

namespace Geoname\Entity\Field;

trait IsHistoric
{
    protected $isHistoric;

    public function setIsHistoric($isHistoric)
    {
        $this->isHistoric = $isHistoric;
        return $this;
    }

    public function getIsHistoric()
    {
        return $this->isHistoric;
    }
}