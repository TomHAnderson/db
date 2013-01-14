<?php

namespace Db\Field;
use Zend\Form\Annotation as Form;

trait EndAt
{
    protected $endAt;

    public function getEndAt()
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTime $value)
    {
        $this->endAt = $value;
        return $this;
    }
}
