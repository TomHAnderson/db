<?php
return array(
    'modules' => array(
//        'Import',

        'Db',
        'DbEtreeOrg',

        'DoctrineModule',
        'DoctrineORMModule',

        'ZfcBase',
        'ZfcUser',
        'ZfcUserDoctrineORM',

//        'ZendDeveloperTools',

        'SoliantEntityAudit',

        'Heartsentwined\Cron',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global}.php',
            'config/autoload/{,*.}{live}.php',
            'config/autoload/{,*.}{local}.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
