<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait PerformerLineups
{
    protected $performerLineups;

    public function getShows() {
        if (!$this->performerLineups)
            $this->performerLineups = new ArrayCollection();

        return $this->performerLineups;
    }
}
