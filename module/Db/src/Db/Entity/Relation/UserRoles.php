<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait UserRoles
{
    protected $userRoles;

    public function getUserRoles()
    {
        if (!$this->userRoles)
            $this->userRoles = new ArrayCollection();

        return $this->userRoles;
    }
}
