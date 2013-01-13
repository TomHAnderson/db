<?php
/**
 * This module is used to define abstacts and other common
 * elements across other modules
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use KeenIO\Service\KeenIO;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        // Configure Keen IO
        $config = $e->getApplication()->getConfig();
        KeenIO::configure($config['keen-io']['projectId'], $config['keen-io']['apiKey']);
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
