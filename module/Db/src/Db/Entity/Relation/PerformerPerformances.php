<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait PerformerPerformances
{
    protected $performerPerformances;

    public function getPerformerPerformances() {
        if (!$this->performerPerformances)
            $this->performerPerformances = new ArrayCollection();

        return $this->performerPerformances;
    }
}
