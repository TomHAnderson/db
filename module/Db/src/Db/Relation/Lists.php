<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Lists
{
    protected $lists;

    public function getLists()
    {
        if (!$this->lists)
            $this->lists = new ArrayCollection();

        return $this->lists;
    }
}
