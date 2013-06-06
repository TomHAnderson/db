<?php
namespace Db\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

abstract class AbstractEntity
{
    use \Db\Form\Element\Submit;

    public function __toString()
    {
        return 'Undefined name';
    }
}