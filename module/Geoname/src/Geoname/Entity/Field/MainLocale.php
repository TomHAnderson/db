<?php

namespace Geoname\Entity\Field;
use Geoname\Entity\Locale;

trait MainLocale
{
    protected $mainLocale;

    public function setMainLocale(Locale $mainLocale)
    {
        $this->mainLocale = $mainLocale;
        return $this;
    }

    public function getMainLocale()
    {
        return $this->mainLocale;
    }
}