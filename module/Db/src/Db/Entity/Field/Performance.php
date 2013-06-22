<?php
namespace Db\Entity\Field;

use Db\Entity\Performance as PerformanceEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait Performance
{
    protected $performance;

    public function getPerformance() {
        return Workspace::filter($this->performance);
   }

    public function setPerformance(PerformanceEntity $value) {
        $this->performance = $value;
        return $this;
    }
}
