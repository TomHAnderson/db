<?php

namespace Audit\Entity\Field;
use Audit\Entity\Revision as RevisionEntity
    ;

trait Revision
{
    protected $revision;

    public function getRevision() {
        return $this->revision;
    }

    function setRevision(RevisionEntity $revision) {
        $this->revision = $revision;
    }
}