<?php
return array(
    'workspace'=> array(
        'entities' => array(
            'Db\Entity\Attendance' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'attendance',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Band' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'band',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\BandAlias' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'band-alias',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\BandGroup' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'band-group',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Checksum' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'checksum',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Event' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'event',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Feedback' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'feedback',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Lineup' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'lineup',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Mail' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'mail',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Performance' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'performance',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\PerformanceSet' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'performance-set',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\PerformanceSetSong' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'performance-set-song',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Performer' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'performer',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\PerformerAlias' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'performer-alias',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\PerformerLineup' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'performer-lineup',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\PerformerPerformance' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'performer-performance',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Producer' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'producer',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Song' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'song',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Source' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'source',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\User' => array(),
            'Db\Entity\UserList' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'user-list',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\UserPerformance' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'user-performance',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\UserPerformanceField' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'user-performance-field',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\UserRole' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'user-role',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Venue' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'venue',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\VenueGroup' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'venue-group',
                    'action' => 'detail',
                ),
            ),
            'Db\Entity\Wanted' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'wanted',
                    'action' => 'detail',
                ),
            ),


            'Db\Entity\AbstractComment' => array(),
            'Db\Entity\AbstractLink' => array(),
        ),

        'datetimeFormat' => 'r',
        'paginatorLimit' => 15,

        'userEntityClassName' => 'ZfcUserDoctrineORM\Entity\User',
        'authenticationService' => 'zfcuser_auth_service',

        'tableNamePrefix' => '',
        'tableNameSuffix' => '_workspace',
        'revisionTableName' => 'Revision',
        'revisionEntityTableName' => 'RevisionEntity',

        'userEntityClassName' => 'Db\Entity\User',
    ),
);

