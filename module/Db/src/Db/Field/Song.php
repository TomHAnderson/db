<?php
namespace Db\Field;

use Db\Entity\Song as SongEntity;

trait Song
{
    protected $song;

    public function getSong()
    {
        return $this->song;
    }

    public function setSong(SongEntity $value)
    {
        $this->song = $value;
        return $this;
    }
}
