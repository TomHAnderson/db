<?php

namespace Geoname\Entity\Relation;
use Doctrine\Common\Collections\ArrayCollection
    , Geoname\Entity\Timezone
    ;

trait Timezones
{
    protected $timezones;

    public function getTimezones()
    {
        if (!$this->timezones)
            $this->timezones = new ArrayCollection();

        return $this->timezones;
    }

    public function addTimezone(Timezone $timezone)
    {
        $this->timezones->add($timezone);
        return $this;
    }

    public function removeTimezone(Timezone $timezone)
    {
        $this->timezones->removeElement($timezone);
        return $this;
    }
}