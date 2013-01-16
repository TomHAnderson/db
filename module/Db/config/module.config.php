<?php

namespace Db;

return array(
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => array(__DIR__ . '/xml'),
            ),

            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),

    'di' => array(
        'instance' => array(
            'alias' => array(
                'modelUser' => 'Db\Model\User',
                'modelState' => 'Db\Model\State',
                'modelCountry' => 'Db\Model\Country',
            ),

            'Db\Model\AbstractModel' => array(
                'parameters' => array(
                    'servicemanager' => 'Zend\ServiceManager\ServiceManager',
                ),
            ),

            'Db\Model\AbstractEntityModel' => array(
                'parameters' => array(
                    'servicemanager' => 'Zend\ServiceManager\ServiceManager',
                    'entitymanager' => 'Doctrine\ORM\EntityManager',
                ),
            ),
        ),
    ),
);
