<?php

namespace Geoname\Entity;

class AltName
{
    use Field\Id
        , Field\Name
        , Field\isPreferred
        , Field\isShort
        , Field\isColloquial
        , Field\isHistoric
        , Field\LanguageOther
        , Field\IsDeprecated
        , Field\Place
        , Field\Language
        ;
}

