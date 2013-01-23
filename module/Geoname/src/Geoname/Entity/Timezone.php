<?php

namespace Geoname\Entity;

class Timezone
{
    use Field\Id
        , Field\Code
        , Field\Offset
        , Field\OffsetJan
        , Field\OffsetJul
        , Field\Country
        ;

    use Relation\Places
        ;
}
