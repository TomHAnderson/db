<?php

namespace Geoname\Entity\Relation;
use Doctrine\Common\Collections\ArrayCollection
    , Geoname\Entity\Feature as Child;
    ;

trait ChildrenFeature
{
    protected $children;

    public function getChildren()
    {
        if (!$this->children)
            $this->children = new ArrayCollection();

        return $this->children;
    }

    public function addChild(Child $child)
    {
        $this->children->add($child);
        return $this;
    }

    public function removeChild(Child $child)
    {
        $this->children->removeElement($child);
        return $this;
    }
}