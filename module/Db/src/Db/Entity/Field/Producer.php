<?php
namespace Db\Entity\Field;

use Db\Entity\Show as ShowEntity;
use Workspace\Service\WorkspaceService as Workspace;

trait Producer
{
    protected $producer;

    public function getProducer()
    {
        return Workspace::filter($this->producer);
    }

    public function setProducer(ProducerEntity $value)
    {
        $this->producer = $value;
        return $this;
    }
}
