<?php
namespace Db\Entity\Field;

use Db\Entity\PerformanceSet as PerformanceSetEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait PerformanceSet
{
    protected $performanceSet;

    public function getPerformanceSet()
    {
        return Workspace::filter($this->performanceSet);
    }

    public function setPerformanceSet(PerformanceSetEntity $value)
    {
        $this->performanceSet = $value;
        return $this;
    }
}
