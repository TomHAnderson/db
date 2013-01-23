<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Lineups
{
    protected $lineups;

    public function getLineups() {
        if (!$this->lineups)
            $this->lineups = new ArrayCollection();

        return $this->lineups;
    }
}
