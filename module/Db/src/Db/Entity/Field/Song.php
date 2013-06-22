<?php
namespace Db\Entity\Field;

use Db\Entity\Song as SongEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait Song
{
    protected $song;

    public function getSong()
    {
        return Workspace::filter($this->song);
    }

    public function setSong(SongEntity $value)
    {
        $this->song = $value;
        return $this;
    }
}
