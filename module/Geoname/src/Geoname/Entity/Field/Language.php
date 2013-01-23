<?php

namespace Geoname\Entity\Field;
use \Geoname\Entity\LanguageEntity;

trait Language
{
    protected $language;

    public function setLanguage(LanguageEntity $language)
    {
        $this->language = $language;
        return $this;
    }

    public function getLanguage()
    {
        return $this->language;
    }
}