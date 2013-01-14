<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Users
{
    protected $users;

    public function getUsers() {
        if (!$this->users)
            $this->users = new ArrayCollection();

        return $this->users;
    }
}
