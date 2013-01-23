<?php

namespace Geoname\Entity\Relation;
use Doctrine\Common\Collections\ArrayCollection
    , Geoname\Entity\Locale
    ;

trait Locales
{
    protected $locales;

    public function getLocales()
    {
        if (!$this->locales)
            $this->locales = new ArrayCollection();

        return $this->locales;
    }

    public function addLocale(Locale $locale)
    {
        $this->locales->add($locale);
        return $this;
    }

    public function removeLocale(Locale $locale)
    {
        $this->locales->removeElement($locale);
        return $this;
    }
}