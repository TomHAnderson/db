<?php
namespace Db\Entity\Field;

use Db\Entity\Place as PlaceEntity;

trait Place
{
    protected $place;

    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace(PlaceEntity $value)
    {
        $this->place = $value;
        return $this;
    }
}
