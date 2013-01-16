<?php
namespace Db\Field;

use Application\Entity\Lineup as LineupEntity;

trait Lineup
{
    protected $lineup;

    public function getLineup()
    {
        return $this->lineup;
    }

    public function setLineup(LineupEntity $value)
    {
        $this->lineup = $value;
        return $this;
    }
}
