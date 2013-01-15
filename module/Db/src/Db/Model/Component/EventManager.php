<?php

namespace Db\Model\Component;
use Zend\EventManager\EventManager as ZendEventManager;

trait EventManager
{
    private $eventManager;

    public function getEventManager()
    {
        if (!$this->eventManager instanceof ZendEventManager) {
            $this->setEventManager(new ZendEventManager(array(
                __CLASS__,
                get_called_class(),
            )));
        }

        return $this->eventManager;
    }

    public function setEventManager(ZendEventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }
}