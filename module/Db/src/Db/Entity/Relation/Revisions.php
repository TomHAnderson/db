<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Revisions
{
    protected $revisions;

    public function getRevisions()
    {
        if (!$this->revisions)
            $this->revisions = new ArrayCollection();

        return $this->revisions;
    }
}
