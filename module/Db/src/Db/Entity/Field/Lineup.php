<?php
namespace Db\Entity\Field;

use Db\Entity\Lineup as LineupEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait Lineup
{
    protected $lineup;

    public function getLineup()
    {
        return Workspace::filter($this->lineup);
    }

    public function setLineup(LineupEntity $value)
    {
        $this->lineup = $value;
        return $this;
    }
}
