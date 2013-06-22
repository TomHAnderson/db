<?php

namespace Db\Entity\Field;

use Db\Entity\Venue as VenueEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait Venue
{
    protected $venue;

    public function getVenue() {
        return Workspace::filter($this->venue);
    }

    public function setVenue(VenueEntity $value) {
        $this->venue = $value;
        return $this;
    }
}
