<?php

namespace Geoname\Entity\Field;
use Geoname\Entity\Feature as FeatureEntity;

trait Feature
{
    protected $feature;

    public function setFeature(FeatureEntity $feature)
    {
        $this->feature = $feature;
        return $this;
    }

    public function getFeature()
    {
        return $this->feature;
    }
}