<?php

namespace Db\Entity\Field;

use Db\Entity\VenueGroup as VenueGroupEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait VenueGroup
{
    protected $venueGroup;

    public function getVenueGroup() {
        return Workspace::filter($this->venueGroup);
    }

    public function setVenueGroup(VenueGroupEntity $value) {
        $this->venueGroup = $value;
        return $this;
    }
}
