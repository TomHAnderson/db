<?php

namespace KeenIO;

return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'serviceKeenIO_project' => 'KeenIO\Service\Project',
                'serviceKeenIO' => 'KeenIO\Service\KeenIO',
            ),

            'KeenIO\Service\KeenIO' => array(
                'parameters' => array(
                    'name' => 'serviceKeenIO',
                ),
            ),

            'KeenIO\Service\Project' => array(
                'parameters' => array(
                    'service' => 'KeenIO\Service\KeenIO',
                ),
            ),
        ),
    ),
);

