<?php
namespace Db\Field;

use Db\Entity\User as UserEntity;

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
