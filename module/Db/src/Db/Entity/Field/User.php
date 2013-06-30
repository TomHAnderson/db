<?php
namespace Db\Entity\Field;

use Db\Entity\User as UserEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait User
{
    protected $user;

    public function getUser()
    {
        return Workspace::filter($this->user);
    }

    public function setUser($value)
    {
        $this->user = $value;
        return $this;
    }
}
