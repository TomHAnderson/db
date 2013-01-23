<?php

namespace Geoname\Entity\Relation;
use Doctrine\Common\Collections\ArrayCollection
    , Geoname\Entity\Place as Child
    ;

#    public funcion addChildren(\HearsenwinedEniy\Place $children)\
#    public funcion removeChildren(\HearsenwinedEniy\Place $children)

trait ChildrenPlace
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

    public function AAAAAremoveChild(Child $child)
    {
        $this->children->removeElement($child);
        return $this;
    }
}