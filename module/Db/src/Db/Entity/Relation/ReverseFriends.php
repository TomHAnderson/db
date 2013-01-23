<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait ReverseFriends
{
    protected $reverseFriends;

    public function getReverseFriends()
    {
        if (!$this->reverseFriends)
            $this->reverseFriends = new ArrayCollection();

        return $this->reverseFriends;
    }
}
