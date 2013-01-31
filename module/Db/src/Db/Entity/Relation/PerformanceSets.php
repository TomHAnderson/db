<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait PerformanceSets
{
    protected $performanceSets;

    public function getPerformanceSets() {
        if (!$this->performanceSets)
            $this->performanceSets = new ArrayCollection();

        return $this->performanceSets;
    }
}
