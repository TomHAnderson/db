<?php
namespace Db\Field;

use Application\Entity\Artist as ArtistEntity;

trait Artist
{
    protected $artist;

    public function getArtist()
    {
        return $this->artist;
    }

    public function setArtist(ArtistEntity $value)
    {
        $this->artist = $value;
        return $this;
    }
}
