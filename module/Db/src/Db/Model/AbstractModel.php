<?php

namespace Db\Model;

use Zend\EventManager\EventManager;
use Zend\EventManager\StaticEventManager;
use Zend\ServiceManager\ServiceManager;
use Doctrine\ORM\EntityManager;

abstract class AbstractModel {

    private $em;
    private $events;
    private $serviceManager;

    public function __construct(ServiceManager $manager, EntityManager $em) {
        $this->setEm($em);
        $this->setServiceManager($manager);
    }

    public function getEm() {
        return $this->em;
    }

    public function setEm(EntityManager $em) {
        $this->em = $em;
        return $this;
    }

    public function setServiceManager(ServiceManager $manager) {
        $this->serviceManager = $manager;
        return $this;
    }

    public function getServiceManager() {
        return $this->serviceManager;
    }

    public function setEventManager(EventManager $events)
    {
        $this->events = $events;
    }

    /**
     * Retrieve the currently set event manager
     *
     * If none is initialized, an EventManager instance will be created with
     * the contexts of this class, the current class name (if extending this
     * class), and "bootstrap".
     *
     * @return Events
     */
    public function events()
    {
        if (!$this->events instanceof Events) {
            $this->setEventManager(new EventManager(array(
                __CLASS__,
                get_called_class(),
            )));
        }
        return $this->events;
    }
}