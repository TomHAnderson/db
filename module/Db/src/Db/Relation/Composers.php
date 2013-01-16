<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Composers
{
    protected $composers;

    public function getComposers() {
        if (!$this->composers)
            $this->composers = new ArrayCollection();

        return $this->composers;
    }
}
