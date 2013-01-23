<?php

namespace Geoname\Entity\Field;

trait Comment
{
    protected $comment;

    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }
}