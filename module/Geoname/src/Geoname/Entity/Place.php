<?php

namespace Geoname\Entity;

class Place
{
    use Field\Id
        , Field\Name
        , Field\Latitude
        , Field\Longitude
        , Field\Elevation
        , Field\DigiEleModel
        , Field\Population
        , Field\CountryCode
        , Field\Admin1Code
        , Field\Admin2Code
        , Field\Admin3Code
        , Field\Admin4Code
        , Field\IsDeprecated
        , Field\Country
        , Field\Feature
        , Field\Timezone
        , Field\ParentPlace
        ;

    use Relation\ChildrenPlace
        , Relation\AltNames
        , Relation\Countries
        , \Db\Entity\Relation\Venues
        , \Db\Entity\Relation\Events
        ;
}