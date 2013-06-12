<?php

namespace DbEtreeOrg;

return array(
    'router' => array(
        'routes' => array(
// Band Alias
            'band-alias' => array(
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
                    'search-json' => array(
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
                            'route' => '/create',
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
//
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
