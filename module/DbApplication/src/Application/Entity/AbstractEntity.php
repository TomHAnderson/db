<?php
namespace Application\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

abstract class AbstractEntity
{
    public function getEntityName()
    {
        return get_class($this);
    }

    public function getClassName()
    {
        return substr($this->getEntityName(), strlen(__NAMESPACE__) + 1);
    }
}