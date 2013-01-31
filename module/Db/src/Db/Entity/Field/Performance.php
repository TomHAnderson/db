<?php
namespace Db\Entity\Field;

use Db\Entity\Performance as PerformanceEntity;

trait Performance
{
    protected $performance;

    public function getPerformance() {
        return $this->performance;
   }

    public function setPerformance(PerformanceEntity $value) {
        $this->performance = $value;
        return $this;
    }
}
