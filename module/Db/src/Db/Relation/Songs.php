<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Songs
{
    protected $songs;

    public function getSongs() {
        if (!$this->songs)
            $this->songs = new ArrayCollection();

        return $this->songs;
    }
}
