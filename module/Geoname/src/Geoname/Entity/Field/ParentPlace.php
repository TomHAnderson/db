<?php

namespace Geoname\Entity\Field;
use Geoname\Entity\Feature as FeatureEntity;

trait ParentPlace
{
    protected $parent;

    public function setParent(FeatureEntity $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    public function getParent()
    {
        return $this->parent;
    }
}