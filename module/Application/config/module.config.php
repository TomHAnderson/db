<?php

namespace Application;

return array(
    'di' => array(
        'instance' => array(
            'Application\Model\ModelAbstract' => array(
                'parameters' => array(
                    'servicemanager' => 'Zend\ServiceManager\ServiceManager',
                    'em' => 'Doctrine\ORM\EntityManager',
                ),
            ),
        ),
    ),
);
