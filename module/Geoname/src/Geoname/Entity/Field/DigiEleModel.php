<?php

namespace Geoname\Entity\Field;

trait DigiEleModel
{
    protected $digiEleModel;

    public function setDigiEleModel($digiEleModel)
    {
        $this->digiEleModel = $digiEleModel;
        return $this;
    }

    public function getDigiEleModel()
    {
        return $this->digiEleModel;
    }
}