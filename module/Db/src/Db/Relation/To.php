<?php
namespace Db\Relation;

use Application\Entity\User as UserEntity;

trait To
{
    protected $to;

    public function getTo()
    {
        return $this->to;
    }

    public function setTo(UserEntity $value)
    {
        $this->to = $value;
        return $this;
    }
}
