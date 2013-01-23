<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Aliases
{
    protected $aliases;

    public function getAliases() {
        if (!$this->aliases)
            $this->aliases = new ArrayCollection();

        return $this->aliases;
    }
}
