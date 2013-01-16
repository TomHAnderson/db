<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Performers
{
    protected $performers;

    public function getPerformers() {
        if (!$this->performers)
            $this->performers = new ArrayCollection();

        return $this->performers;
    }
}
