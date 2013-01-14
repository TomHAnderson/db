<?php
namespace Db\Field;

use Application\Entity\Event as EventEntity;

trait Event
{
    protected $event;

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent(EventEntity $value)
    {
        $this->event = $value;
        return $this;
    }
}
