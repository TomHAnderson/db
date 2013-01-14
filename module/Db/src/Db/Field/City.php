<?php
namespace Db\Field;

use Application\Entity\Artist as CityEntity;

trait City
{
    protected $city;

    public function getCity()
    {
        return $this->city;
    }

    public function setCity(CityEntity $value)
    {
        $this->city = $value;
        return $this;
    }
}
