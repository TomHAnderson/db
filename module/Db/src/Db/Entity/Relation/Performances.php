<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Performances
{
    protected $performances;

    public function getPerformances() {
        if (!$this->performances)
            $this->performances = new ArrayCollection();

        return $this->performances;
    }
}
