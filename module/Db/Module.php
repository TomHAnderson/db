<?php

namespace Db;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Doctrine\ORM\EntityManager;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        self::setEntityManager($e->getApplication()->getServiceManager()->get('doctrine.entitymanager.orm_default'));
    }

    static private $entityManager;

    static public function getEntityManager()
    {
        return self::$entityManager;
    }

    static public function setEntityManager(EntityManager $entityManager)
    {
        self::$entityManager = $entityManager;
    }
}

