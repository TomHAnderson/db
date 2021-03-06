<?php
namespace Db\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\Common\Collections\ArrayCollection;
use Workspace\Service\WorkspaceService as Workspace;

abstract class AbstractEntity
{
    public function __toString()
    {
        throw new \Excepction('__toString not implemented');
    }

    public function __call($name, $params)
    {
        if (substr($name, 0, 3) !== 'get') {
            throw new \Exception("Method not found: $name");
        }

        $property = strtolower(substr($name, 3, 1)) . substr($name, 4);

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