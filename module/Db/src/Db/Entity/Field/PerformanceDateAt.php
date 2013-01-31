<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait PerformanceDateAt
{
    protected $performanceDateAt;

    public function getPerformanceDateAt()
    {
        return $this->performanceDateAt;
    }

    public function setPerformanceDateAt(\DateTime $performanceDateAt) {
        $this->performanceDateAt = $performanceDateAt;
        return $this;
    }
}
