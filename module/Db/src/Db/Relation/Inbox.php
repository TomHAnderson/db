<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Inbox
{
    protected $inbox;

    public function getInbox()
    {
        if (!$this->inbox)
            $this->inbox = new ArrayCollection();

        return $this->inbox;
    }
}
