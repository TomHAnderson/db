<?php
namespace Db\Entity\Field;

use Db\Entity\BandGroup as BandGroupEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait BandGroup
{
    protected $bandGroup;

    public function getBandGroup()
    {
        return Workspace::filter($this->bandGroup);
    }

    public function setBandGroup($value)
    {
        if ($value instanceof BandGroupEntity) {
            $this->bandGroup = $value;
        } else if (!$value) {
            $this->bandGroup = null;
        } else {
            throw new \Exception('Invalid Band Group in setter');
        }

        return $this;
    }
}
