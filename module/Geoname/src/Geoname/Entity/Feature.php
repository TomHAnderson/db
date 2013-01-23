<?php

namespace Geoname\Entity;

class Feature
{
    use Field\Id
        , Field\Code
        , Field\Description
        , Field\Comment
        , Field\ParentFeature
        ;

    use Relation\ChildrenFeature
        , Relation\Places
        ;
}
