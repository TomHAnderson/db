<?php

namespace Geoname\Entity;

class Currency
{
    use Field\Id
        , Field\Code
        , Field\Name
        ;

    use Relation\Countries
        ;
}
