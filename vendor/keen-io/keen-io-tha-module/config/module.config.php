<?php

namespace KeenIO;

return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'keenIOProject' => 'KeenIO\Service\Project',
                'keenIOService' => 'KeenIO\Service\KeenIO',
            ),

            'KeenIO\Service\KeenIO' => array(
                'parameters' => array(
                    'name' => 'KeenIOService',
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

