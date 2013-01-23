<?php

namespace Db\Entity\Field;

use Db\Entity\VenueGroup as VenueGroupEntity;

trait VenueGroup
{
    protected $venueGroup;

    public function getVenueGroup() {
        return $this->venueGroup;
    }

    public function setVenueGroup(VenueGroupEntity $value) {
        $this->venueGroup = $value;
        return $this;
    }
}
