<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Checksums
{
    protected $checksums;

    public function getChecksums() {
        if (!$this->checksums)
            $this->checksums = new ArrayCollection();

        return $this->checksums;
    }
}
