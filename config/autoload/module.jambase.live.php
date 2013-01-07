<?php

namespace Jambase;

$apiKey = '8yr78nmh5uddsqj3gv9x6kzf';

/** ==== End User Edit ==== **/

return array(
    'di' => array(
        'instance' => array(
            'Jambase\Service\Jambase' => array(
                'parameters' => array(
                    'apiKey' => $apiKey,
                ),
            ),
        ),
    ),
);