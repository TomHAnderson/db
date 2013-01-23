<?php

namespace Geoname\Entity;

class Country
{
    use Field\Id
        , Field\Name
        , Field\Abbrev
        , Field\Iso3
        , Field\Iso2
        , Field\IsoNum
        , Field\Capital
        , Field\Area
        , Field\Population
        , Field\Tld
        , Field\Phone
        , Field\PostalCode
        , Field\PostalCodeRegex
        , Field\Place
        , Field\Currency
        , Field\Continent
        , Field\mainLocale
        ;

    use Relation\Timezones
        , Relation\Locales
        , Relation\Neighbours
        ;
}
