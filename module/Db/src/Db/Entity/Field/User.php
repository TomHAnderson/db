<?php
namespace Db\Entity\Field;

use Db\Entity\User as UserEntity;

trait User
{
    protected $user;

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(UserEntity $value)
    {
        $this->user = $value;
        return $this;
    }
}
