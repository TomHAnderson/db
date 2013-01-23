<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Attendance
{
    protected $attendance;

    public function getAttendance()
    {
        if (!$this->attendance)
            $this->attendance = new ArrayCollection();

        return $this->attendance;
    }
}
