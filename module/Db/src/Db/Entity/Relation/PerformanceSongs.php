<?php

namespace Db\Entity\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait PerformanceSongs
{
    protected $performanceSongs;

    public function getPerformanceSongs()
    {
        if (!$this->performanceSongs)
            $this->performanceSongs = new ArrayCollection();

        return $this->performanceSongs;
    }
}
