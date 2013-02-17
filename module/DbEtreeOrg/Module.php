<?php
/**
 * The application for db.etree.org
 */

namespace DbEtreeOrg;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent
    , Gracenote\Service\Gracenote
    ;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        session_start();

        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        // Disable zfcuser doctrine default entities
        $options = $e->getApplication()->getServiceManager()->get('zfcuser_module_options');
        $options->setEnableDefaultEntities(false);

        $config = $e->getApplication()->getConfig();

        Gracenote::configure($config['gracenote']['clientId'], $config['gracenote']['userId']);
    }

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
}
