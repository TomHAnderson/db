<?php
return array(
    'audit'=> array(
        'entities' => array(
            'Db\Entity\Performer' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'song',
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
            'Db\Entity\Event' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'event',
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
            'Db\Entity\Lineup' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'lineup',
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
            'Db\Entity\BandGroup' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'band-group',
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
            'Db\Entity\Source' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'source',
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
            'Db\Entity\PerformanceSetSong' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'performance-set-song',
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
            'Db\Entity\AbstractComment' => array(),
            'Db\Entity\AbstractLink' => array(),
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
        ),

        'entityDatamap' => array(
            'Db\Entity\Song' => array(
                'route' => 'default',
                'defaults' => array(
                    'controller' => 'song',
                    'action' => 'detail',
                ),
            ),
        ),

        'datetime.format' => 'r',
        'paginator.limit' => 15,

        'tableNamePrefix' => '',
        'tableNameSuffix' => '_audit',
        'revisionTableName' => 'Revision',
        'revisionEntityTableName' => 'RevisionEntity',

        'userEntityClassName' => 'Db\Entity\User',
    ),
);

