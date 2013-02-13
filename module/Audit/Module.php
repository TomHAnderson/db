<?php

namespace Audit;

use Zend\Mvc\MvcEvent
    , SimpleThings\EntityAudit\AuditConfiguration
    , SimpleThings\EntityAudit\AuditManager
    , SimpleThings\EntityAudit\EventListener\CreateSchemaListener
    , SimpleThings\EntityAudit\EventListener\LogRevisionsListener
    ;

class Module
{
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
        $sm = $e->getApplication()->getServiceManager();
        $auditManager = $sm->get("auditManager");
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                "auditConfig"  => function($serviceManager)
                {
                    $config = $serviceManager->get("Config");
                    $auditconfig = new AuditConfiguration();
                    $auditconfig->setAuditedEntityClasses($config['audit']['entities']);
                    return $auditconfig;
                },

                "auditManager" => function ($serviceManager)
                {
                    $eventManager = $serviceManager->get("doctrine.eventmanager.orm_default");
                    $config = $serviceManager->get("Config");
                    $auditconfig = $serviceManager->get("auditConfig");

                    $auth = $serviceManager->get('zfcuser_auth_service');
                    if ($auth->hasIdentity()) {
                        $auditconfig->setUser($auth->getIdentity());
                    } else {
                        //throw new \Exception('user is not authenticated');
                    }

                    $auditManager = new AuditManager($auditconfig);
                    $eventManager->addEventSubscriber(new CreateSchemaListener($auditManager));
                    $eventManager->addEventSubscriber(new LogRevisionsListener($auditManager));
                    return $auditManager;
                },

                "auditReader" => function($sm)
                {
                    $auditManager = $sm->get("auditManager");
                    $entityManager = $sm->get('doctrine.entitymanager.orm_default');
                    return $auditManager->createAuditReader($entityManager);
                }
            ),
        );
    }
}