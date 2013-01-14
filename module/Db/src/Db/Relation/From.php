<?php
namespace Db\Relation;

use Application\Entity\User as UserEntity;

trait From
{
    protected $from;

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom(UserEntity $value)
    {
        $this->from = $value;
        return $this;
    }
}
