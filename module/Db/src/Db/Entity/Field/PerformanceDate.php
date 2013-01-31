<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait PerformanceDate
{
    protected $performanceDate;

    public function getPerformanceDate()
    {
        return $this->performanceDate;
    }

    public function setPerformanceDate($performanceDate) {
        $this->performanceDate = $performanceDate;
        return $this;
    }
}
