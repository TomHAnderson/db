<?php

namespace Audit;

return array(
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

    'router' => array(
        'routes' => array(
            'audit_index' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/audit',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Audit\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                        'page' => "1"
                    ),
                ),
            ),
            'audit_log' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/audit/log[/:page]',
                    'constraints' => array(
                        'page' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Audit\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                        'page' => '1'
                    )
                )
            ),
            'audit_viewrevision' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/audit/revision[/:rev]',
                    'constraints' => array(
                        'rev' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Audit\Controller',
                        'controller' => 'Index',
                        'action' => 'viewrevision',
                        'rev' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    )
                )
            ),
            'audit_viewentity' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/audit/entity[/:id[/:className]]',
                    'constraints' =>array(
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Audit\Controller',
                        'controller' => 'Index',
                        'action' => 'viewentity',
                        'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'className' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    )
                )
            ),
            'audit_viewdetails' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/audit/details[/:id[/:className[/:rev]]]',
                    'constraints' =>array(
                        'id' => '[0-9]*',
                        'rev' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Audit\Controller',
                        'controller' => 'Index',
                        'action' => 'viewdetail',
                        'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'className' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'rev' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    )
                )
            ),
            'audit_compare' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/audit/compare[/:className[/:id]]',
                    'constraints' =>array(
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Audit\Controller',
                        'controller' => 'Index',
                        'action' => 'compare',
                        'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'className' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                )
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'Audit\Controller\Index' => 'Audit\Controller\IndexController'
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);