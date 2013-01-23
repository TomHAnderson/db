<?php

namespace Geoname;
use Zend\Mvc\MvcEvent as Event;

/**
 * Geoname module
 *
 * @author Tom Anderson <tom.h.anderson@gmail.com>
 * @author heartsentwined <heartsentwined@cogito-lab.com>
 * @license GPL http://opensource.org/licenses/gpl-license.php
 */
class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function onBootstrap(Event $e)
    {
        $e->getApplication()->getServiceManager()->get('geoname')->registerCron();
    }
}
