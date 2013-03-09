<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait PerformanceSetSongs
{
    protected $performanceSetSongs;

    public function getPerformanceSetSongs()
    {
        if (!$this->performanceSetSongs)
            $this->performanceSetSongs = new ArrayCollection();

        return $this->performanceSetSongs;
    }
}
