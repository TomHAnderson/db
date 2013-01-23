<?php

namespace Geoname;

return array();


/*
    'di' => array(
        'instance' => array(
            'alias' => array(
                'geoname' => 'Geoname\Service\Geoname',
                'geoname-cli' => 'Heartsentwined\Cli\Cli',
                'browser' => 'Heartsentwined\Browser\Factory',
            ),

            'Geoname\Service\Geoname' => array(
                'parameters' => array(
                    'entityManager' => 'Doctrine\ORM\EntityManager',
                    'cli' => 'geoname-cli',
                    'tmpDir' => 'data/geoname',
                    'cron' => '* /15 * * * *',
                ),
            ),

            'geoname-cli' => array(
                'parameters' => array(
                    'templates' => array(
                        'section' => array(
                            'template' => '## %s ##',
                            'color' => 'YELLOW',
                        ),
                        'task' => array(
                            'template' => '-%s -',
                            'color' => 'BLUE',
                        ),
                        'module' => array(
                            'template' => '[ %s ]',
                            'color' => 'GREEN ',
                        ),
                    ),
                ),
            ),
        ),
    ),

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
);

*/