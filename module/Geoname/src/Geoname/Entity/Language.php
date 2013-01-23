<?php

namespace Geoname\Entity;

class Language
{
    use Field\Id
        , Field\Name
        , Field\Iso3
        , Field\Iso2
        , Field\Iso1
        ;

    use Relation\Locales
        ;
}