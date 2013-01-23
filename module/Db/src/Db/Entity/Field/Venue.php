<?php

namespace Db\Entity\Field;

use Db\Entity\Venue as VenueEntity;

trait Venue
{
    protected $venue;

    public function getVenue() {
        return $this->venue;
    }

    public function setVenue(VenueEntity $value) {
        $this->venue = $value;
        return $this;
    }
}
