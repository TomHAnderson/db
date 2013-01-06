<?php
return array(
    'modules' => array(
        'Application',
        'Install',

        'DoctrineModule',
        'DoctrineORMModule',

        'ZfcBase',
        'ZfcUser',
        'ZfcUserDoctrineORM',

        'KeenIO',
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
