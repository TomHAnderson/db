<?php

namespace Etreedb;

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
                'modelFitness' => 'Db\Model\Fitness',
                'modelTeam' => 'Db\Model\Team',
                'modelFriend' => 'Db\Model\Friend',
            ),
        ),
    ),
);
