<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait PendingQueue
{
    protected $pendingQueue;

    public function getPendingQueue()
    {
        if (!$this->pendingQueue)
            $this->pendingQueue = new ArrayCollection();

        return $this->pendingQueue;
    }
}
