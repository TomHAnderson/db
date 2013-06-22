<?php
namespace Db\Entity\Field;

use Db\Entity\Band as BandEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait Band
{
    protected $band;

    public function getBand()
    {
        return Workspace::filter($this->band);
    }

    public function setBand($value)
    {
        if ($value !== null and ! $value instanceof BandEntity) {
            throw new \Exception('Catchable fatal error: Argument 1 passed to
                Db\Entity\Song::setBand() must be an instance of Db\Entity\Band or null');
        }
        $this->band = $value;
        return $this;
    }
}
