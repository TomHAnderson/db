<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Events
{
    protected $events;

    public function getEvents() {
        if (!$this->events)
            $this->events = new ArrayCollection();

        return $this->events;
    }
}
