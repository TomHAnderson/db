<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait UserShows
{
    protected $userShows;

    public function getUserShows() {
        if (!$this->userShows)
            $this->userShows = new ArrayCollection();

        return $this->userShows;
    }
}
