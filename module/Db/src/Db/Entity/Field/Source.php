<?php

namespace Db\Entity\Field;

use Db\Entity\Source as SourceEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait Source
{
    protected $source;

    public function getSource()
    {
        return Workspace::filter($this->source);
    }

    public function setSource(SourceEntity $value)
    {
        $this->source = $value;
        return $this;
    }
}
