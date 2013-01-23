<?php

namespace Geoname\Entity\Field;

trait LanguageOther
{
    protected $languageOther;

    public function setLanguageOther($languageOther)
    {
        $this->languageOther = $languageOther;
        return $this;
    }

    public function getLanguageOther()
    {
        return $this->languageOther;
    }
}