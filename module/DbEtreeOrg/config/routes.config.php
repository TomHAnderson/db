<?php

namespace DbEtreeOrg;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'menu' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/menu',
                    'defaults' => array(
                        'controller' => 'index',
                        'action'     => 'menu',
                    ),
                ),
            ),

// Band Alias
            'bandAlias' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/band-alias',
                    'defaults' => array(
                        'controller' => 'band-alias',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/detail[/:bandAliasid]',
                            'defaults' => array(
                                'controller' => 'band-alias',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/create[/:bandId]',
                            'defaults' => array(
                                'controller' => 'band-alias',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/edit[/:bandAliasid]',
                            'defaults' => array(
                                'controller' => 'band-alias',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/delete[/:bandAliasid]',
                            'defaults' => array(
                                'controller' => 'band-alias',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                ),
            ),
// Band
            'band' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/band',
                    'defaults' => array(
                        'controller' => 'band',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/detail[/:bandId]',
                            'defaults' => array(
                                'controller' => 'band',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/create',
                            'defaults' => array(
                                'controller' => 'band',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/edit[/:bandId]',
                            'defaults' => array(
                                'controller' => 'band',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/delete[/:bandId]',
                            'defaults' => array(
                                'controller' => 'band',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'searchJson' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/search/json',
                            'defaults' => array(
                                'controller' => 'band',
                                'action'     => 'searchJson',
                            ),
                        ),
                    ),
                ),
            ),
// Checksum
            'checksum' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/checksum',
                    'defaults' => array(
                        'controller' => 'checksum',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/detail[/:checksumId]',
                            'defaults' => array(
                                'controller' => 'checksum',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/create[/:sourceId]',
                            'defaults' => array(
                                'controller' => 'checksum',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/edit[/:checksumId]',
                            'defaults' => array(
                                'controller' => 'checksum',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/delete[/:checksumId]',
                            'defaults' => array(
                                'controller' => 'checksum',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                ),
            ),

// Comments
            'comment' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/comment',
                    'defaults' => array(
                        'controller' => 'comment',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'delete' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/delete[/:commentId]',
                            'defaults' => array(
                                'controller' => 'comment',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/create[/:entityName][/:id]',
                            'defaults' => array(
                                'controller' => 'comment',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                ),
            ),

// Lineup
            'lineup' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/lineup',
                    'defaults' => array(
                        'controller' => 'lineup',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/detail[/:lineupId]',
                            'defaults' => array(
                                'controller' => 'lineup',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/create[/:bandId]',
                            'defaults' => array(
                                'controller' => 'lineup',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/edit[/:lineupId]',
                            'defaults' => array(
                                'controller' => 'lineup',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/delete[/:lineupId]',
                            'defaults' => array(
                                'controller' => 'lineup',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'addPerformer' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/add-performer[/:lineupId]',
                            'defaults' => array(
                                'controller' => 'lineup',
                                'action'     => 'addPerformer',
                            ),
                        ),
                    ),
                    'removePerformer' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/remove-performer[/:lineupId][/:performerId]',
                            'defaults' => array(
                                'controller' => 'lineup',
                                'action'     => 'removePerformer',
                            ),
                        ),
                    ),
                ),
            ),

// Links
            'link' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/link',
                    'defaults' => array(
                        'controller' => 'link',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'create' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/create[/:entityName][/:id]',
                            'defaults' => array(
                                'controller' => 'link',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/edit[/:entityName][/:id]',
                            'defaults' => array(
                                'controller' => 'link',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/delete[/:entityName][/:linkId]',
                            'defaults' => array(
                                'controller' => 'link',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                ),
            ),

// Performance
            'performance' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/performance',
                    'defaults' => array(
                        'controller' => 'performance',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/performance[/:performanceId]',
                            'defaults' => array(
                                'controller' => 'performance',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/create[/:lineupId]',
                            'defaults' => array(
                                'controller' => 'performance',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/edit[/:performanceId]',
                            'defaults' => array(
                                'controller' => 'performance',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/delete[/:performanceId]',
                            'defaults' => array(
                                'controller' => 'performance',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'addPerformer' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/add-performer[/:performanceId]',
                            'defaults' => array(
                                'controller' => 'performance',
                                'action'     => 'addPerformer',
                            ),
                        ),
                    ),
                    'removePerformer' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/remove-performer[/:performanceId][/:performerId]',
                            'defaults' => array(
                                'controller' => 'performance',
                                'action'     => 'removePerformer',
                            ),
                        ),
                    ),
                ),
            ),

/////////
            'source' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/source',
                    'defaults' => array(
                        'controller' => 'source',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'source',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
            'performer-alias' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/performer-alias',
                    'defaults' => array(
                        'controller' => 'performer-alias',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
#                'child_routes' => array(
#                    'detail' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'band',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
