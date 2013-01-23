<?php

namespace Geoname\Entity\Field;
use Geoname\Entity\Timezone as TimezoneEntity;

trait Timezone
{
    protected $timezone;

    public function setTimezone(TimezoneEntity $timezone)
    {
        $this->timezone = $timezone;
        return $this;
    }

    public function getTimezone()
    {
        return $this->timezone;
    }
}