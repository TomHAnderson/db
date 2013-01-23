<?php
namespace Db\Entity\Field;

use Db\Entity\Lineup as LineupEntity;

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
