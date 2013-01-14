<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Groups
{
    protected $groups;

    public function getGroups() {
        if (!$this->groups)
            $this->groups = new ArrayCollection();

        return $this->groups;
    }
}
