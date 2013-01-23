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
                'modelCountry' => 'Db\Model\Country',
                'modelState' => 'Db\Model\State',
                'modelPlace' => 'Db\Model\Place',

                'modelVenue' => 'Db\Model\Venue',
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

