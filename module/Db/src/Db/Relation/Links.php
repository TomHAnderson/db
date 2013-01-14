<?php

namespace Db\Relation;
use Zend\Form\Annotation as Form;
use Doctrine\Common\Collections\ArrayCollection;

trait Links
{
    protected $links;

    public function getLinks() {
        if (!$this->links)
            $this->links = new ArrayCollection();

        return $this->links;
    }
}
