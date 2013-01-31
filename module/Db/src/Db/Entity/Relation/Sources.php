<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Sources
{
    protected $sources;

    public function getSources() {
        if (!$this->sources)
            $this->sources = new ArrayCollection();

        return $this->sources;
    }
}
