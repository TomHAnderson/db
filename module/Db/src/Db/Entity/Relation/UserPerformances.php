<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait UserPerformances
{
    protected $userPerformances;

    public function getUserPerformances() {
        if (!$this->userPerformances)
            $this->userPerformances = new ArrayCollection();

        return $this->userPerformances;
    }
}
