<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait WantedBy
{
    protected $wantedBy;

    public function getWantedBy()
    {
        if (!$this->wantedBy)
            $this->wantedBy = new ArrayCollection();

        return $this->wantedBy;
    }
}
