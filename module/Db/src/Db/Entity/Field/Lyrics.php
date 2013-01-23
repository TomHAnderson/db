<?php
namespace Db\Entity\Field;

use Db\Entity\Lyrics as LyricsEntity;

trait Lyrics
{
    protected $lyrics;

    public function getLyrics()
    {
        return $this->lyrics;
    }

    public function setLyrics(LyricsEntity $value)
    {
        $this->lyrics = $value;
        return $this;
    }
}
