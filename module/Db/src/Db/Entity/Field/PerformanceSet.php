<?php
namespace Db\Entity\Field;

use Db\Entity\Set as SetEntity;

trait PerformanceSet
{
    protected $performanceSet;

    public function getPerformanceSet()
    {
        return $this->performanceSet;
    }

    public function setPerformanceSet(PerformanceSetEntity $value)
    {
        $this->performanceSet = $value;
        return $this;
    }
}
