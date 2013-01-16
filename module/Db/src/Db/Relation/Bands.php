<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Bands
{
    protected $bands;

    public function getBands() {
        if (!$this->bands)
            $this->bands = new ArrayCollection();

        return $this->bands;
    }
}
