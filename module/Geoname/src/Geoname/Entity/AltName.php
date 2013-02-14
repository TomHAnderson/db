<?php

namespace Geoname\Entity;

class AltName
{
    use Field\Id
        , Field\Name
        , Field\IsPreferred
        , Field\IsShort
        , Field\IsColloquial
        , Field\IsHistoric
        , Field\LanguageOther
        , Field\IsDeprecated
        , Field\Place
        , Field\Language
        ;
}

