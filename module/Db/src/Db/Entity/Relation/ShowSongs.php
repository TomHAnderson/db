<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait ShowSongs
{
    protected $showSongs;

    public function getShowSongs()
    {
        if (!$this->showSongs)
            $this->showSongs = new ArrayCollection();

        return $this->showSongs;
    }
}
