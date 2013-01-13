<?php
return array(
    'modules' => array(
        'Install',

        'Db',
        'Etreedb',

        'DbApplication',

        'DoctrineModule',
        'DoctrineORMModule',

        'ZfcBase',
        'ZfcUser',
        'ZfcUserDoctrineORM',

        'KeenIO',
        'Jambase',
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
