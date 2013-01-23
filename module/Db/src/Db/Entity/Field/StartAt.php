<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait StartAt
{
    protected $startAt;

    public function getStartAt()
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTime $value)
    {
        $this->startAt = $value;
        return $this;
    }
}
