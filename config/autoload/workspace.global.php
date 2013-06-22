<?php
return array(
    'workspace'=> array(
        'entities' => array(
            'Db\Entity\Attendance' => array(
                'route' => 'attendance/detail',
            ),
            'Db\Entity\Band' => array(
                'route' => 'band/detail',
            ),
            'Db\Entity\BandAlias' => array(
                'route' => 'bandAlias/detail',
            ),
            'Db\Entity\BandGroup' => array(
                'route' => 'bandGroup/detail',
            ),
            'Db\Entity\Checksum' => array(
                'route' => 'checksum/detail',
            ),
            'Db\Entity\Event' => array(
                'route' => 'event/detail',
            ),
            'Db\Entity\Feedback' => array(
                'route' => 'feedback/detail',
            ),
            'Db\Entity\Lineup' => array(
                'route' => 'lineup/detail',
            ),
            'Db\Entity\Mail' => array(
                'route' => 'mail/detail',
            ),
            'Db\Entity\Performance' => array(
                'route' => 'performance/detail',
            ),
            'Db\Entity\PerformanceSet' => array(
                'route' => 'performanceSet/detail',
            ),
            'Db\Entity\PerformanceSetSong' => array(
                'route' => 'performanceSetSong/detail',
            ),
            'Db\Entity\Performer' => array(
                'route' => 'performer/detail',
            ),
            'Db\Entity\PerformerAlias' => array(
                'route' => 'performerAlias/detail',
            ),
            'Db\Entity\PerformerLineup' => array(
                'route' => 'performerLineup/detail',
            ),
            'Db\Entity\PerformerPerformance' => array(
                'route' => 'performerPerformance/detail',
            ),
            'Db\Entity\Producer' => array(
                'route' => 'producer/detail',
            ),
            'Db\Entity\Song' => array(
                'route' => 'song/detail',
            ),
            'Db\Entity\Source' => array(
                'route' => 'source/detail',
            ),
            'Db\Entity\User' => array(
                'route' => 'user/profile',
            ),
            'Db\Entity\UserList' => array(
                'route' => 'userlist/detail',
            ),
            'Db\Entity\UserPerformance' => array(
                'route' => 'userPerformance/detail',
            ),
            'Db\Entity\UserPerformanceField' => array(
                'route' => 'userPerformanceField/detail',
            ),
            'Db\Entity\UserRole' => array(
                'route' => 'userRole/detail',
            ),
            'Db\Entity\Venue' => array(
                'route' => 'venue/detail',
            ),
            'Db\Entity\VenueGroup' => array(
                'route' => 'venuegroup/detail',
            ),
            'Db\Entity\Wanted' => array(
                'route' => 'wanted/detail',
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