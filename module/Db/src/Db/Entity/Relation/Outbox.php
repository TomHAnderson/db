<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Outbox
{
    protected $outbox;

    public function getOutbox()
    {
        if (!$this->outbox)
            $this->outbox = new ArrayCollection();

        return $this->outbox;
    }
}
