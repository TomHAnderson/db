<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Import;

return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
        'aliases' => array(
            'db' => 'Zend\Db\Adapter\Adapter',
        ),
    ),

    'db' => array(
        'driver'    => 'pdo',
        'dsn'       => 'mysql:dbname=db;host=localhost',
        'username'  => 'root',
        'password'  => '',
        'driver_options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
         ),
    ),

    'router' => array(
        'routes' => array(
            'import' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/import[/:action]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'import',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'serviceImport' => 'Import\Service\Import',
            ),

            'Import\Service\Import' => array(
                'parameters' => array(
                    'servicemanager' => 'Zend\ServiceManager\ServiceManager',
                    'entitymanager' => 'Doctrine\ORM\EntityManager',
                    'cron' => '*/5 * * * *',
                ),
            ),
        ),
    ),
);
