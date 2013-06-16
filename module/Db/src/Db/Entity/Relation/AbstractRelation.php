<?php

namespace Db\Entity\Relation;

use Doctrine\Common\Collections\ArrayCollection;
use Workspace\Service\WorkspaceService as Workspace;

trait AbstractRelation
{
    public function getProperty()
    {
        // Find property name based on aliased trait function name
        $trace = debug_backtrace();
        $property = strtolower(substr($trace[0]["function"], 3, 1)) . substr($trace[0]["function"], 4);

        $filtered = new ArrayCollection();

        if (!$this->$property)
            $this->$property = new ArrayCollection();

        foreach($this->$property as $entity) {
            if ($filteredEntity = Workspace::filter($entity)) {
                $filtered->add($filteredEntity);
            }
        }

        return $filtered;
    }
}
