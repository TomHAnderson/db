<?php
namespace Db\Entity\Field;

use Db\Entity\User as UserEntity;

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
