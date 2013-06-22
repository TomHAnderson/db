<?php
namespace Db\Entity\Field;

use Db\Entity\Performer as PerformerEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait Performer
{
    protected $performer;

    public function getPerformer()
    {
        return Workspace::filter($this->performer);
    }

    public function setPerformer(PerformerEntity $value)
    {
        $this->performer = $value;
        return $this;
    }
}
