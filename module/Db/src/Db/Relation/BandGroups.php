<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait BandGroups
{
    protected $bandGroups ;

    public function getBandGroups() {
        if (!$this->bandGroups )
            $this->bandGroups  = new ArrayCollection();

        return $this->bandGroups ;
    }
}
