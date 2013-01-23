<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait States
{
    protected $states;

    public function getStates() {
        if (!$this->states)
            $this->states = new ArrayCollection();

        return $this->states;
    }
}
