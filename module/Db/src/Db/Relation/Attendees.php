<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Attendees
{
    protected $attendees;

    public function getAttendees()
    {
        if (!$this->attendees)
            $this->attendees = new ArrayCollection();

        return $this->attendees;
    }
}
