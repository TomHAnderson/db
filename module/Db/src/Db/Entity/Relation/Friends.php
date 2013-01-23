<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Friends
{
    protected $friends;

    public function getFriends()
    {
        if (!$this->friends)
            $this->friends = new ArrayCollection();

        return $this->friends;
    }
}
