<?php
namespace Db\Entity\Field;

trait Lyrics
{
    protected $lyrics;

    public function getLyrics()
    {
        return $this->lyrics;
    }

    public function setLyrics($value)
    {
        $this->lyrics = $value;
        return $this;
    }
}
