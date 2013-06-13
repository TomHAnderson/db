<?php
namespace Db\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

abstract class AbstractEntity
{
    public function __toString()
    {
        throw new \Excepction('__toString not implemented');
    }
}