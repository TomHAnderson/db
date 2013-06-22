<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

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
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'band-alias',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:bandId]',
                            'defaults' => array(
                                'controller' => 'band-alias',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:bandAliasid]',
                            'defaults' => array(
                                'controller' => 'band-alias',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
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
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
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
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:bandId]',
                            'defaults' => array(
                                'controller' => 'band',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
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
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'checksum',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:sourceId]',
                            'defaults' => array(
                                'controller' => 'checksum',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:checksumId]',
                            'defaults' => array(
                                'controller' => 'checksum',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
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
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:commentId]',
                            'defaults' => array(
                                'controller' => 'comment',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Segment',
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
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'lineup',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:bandId]',
                            'defaults' => array(
                                'controller' => 'lineup',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:lineupId]',
                            'defaults' => array(
                                'controller' => 'lineup',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:lineupId]',
                            'defaults' => array(
                                'controller' => 'lineup',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'addPerformer' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/add-performer[/:lineupId]',
                            'defaults' => array(
                                'controller' => 'lineup',
                                'action'     => 'addPerformer',
                            ),
                        ),
                    ),
                    'removePerformer' => array(
                        'type' => 'Segment',
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
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:entityName][/:id]',
                            'defaults' => array(
                                'controller' => 'link',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:entityName][/:id]',
                            'defaults' => array(
                                'controller' => 'link',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
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
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/performance[/:id]',
                            'defaults' => array(
                                'controller' => 'performance',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:lineupId]',
                            'defaults' => array(
                                'controller' => 'performance',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:performanceId]',
                            'defaults' => array(
                                'controller' => 'performance',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:performanceId]',
                            'defaults' => array(
                                'controller' => 'performance',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'addPerformer' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/add-performer[/:performanceId]',
                            'defaults' => array(
                                'controller' => 'performance',
                                'action'     => 'addPerformer',
                            ),
                        ),
                    ),
                    'removePerformer' => array(
                        'type' => 'Segment',
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

// Performance Set
            'performanceSet' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/performanceSet',
                    'defaults' => array(
                        'controller' => 'performanceSet',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'performanceSet',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:performanceId]',
                            'defaults' => array(
                                'controller' => 'performanceSet',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:performanceSetId]',
                            'defaults' => array(
                                'controller' => 'performanceSet',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:performanceSetId]',
                            'defaults' => array(
                                'controller' => 'performanceSet',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'sortPerformanceSetSongs' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/songs/sort[/:performanceSetId]',
                            'defaults' => array(
                                'controller' => 'performanceSet',
                                'action'     => 'sortPerformanceSetSongs',
                            ),
                        ),
                    ),
                ),
            ),

// Performance Set Song
            'performanceSetSong' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/performanceSetSong',
                    'defaults' => array(
                        'controller' => 'performanceSetSong',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'performanceSetSong',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:performanceSetId]',
                            'defaults' => array(
                                'controller' => 'performanceSetSong',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:performanceSetSongId]',
                            'defaults' => array(
                                'controller' => 'performanceSetSong',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:performanceSetSongId]',
                            'defaults' => array(
                                'controller' => 'performanceSetSong',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                ),
            ),

// Performer Alias
            'performerAlias' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/performerAlias',
                    'defaults' => array(
                        'controller' => 'performerAlias',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'performerAlias',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:performerId]',
                            'defaults' => array(
                                'controller' => 'performerAlias',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:performerAliasId]',
                            'defaults' => array(
                                'controller' => 'performerAlias',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:performerAliasId]',
                            'defaults' => array(
                                'controller' => 'performerAlias',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                ),
            ),
// Performer
            'performer' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/performer',
                    'defaults' => array(
                        'controller' => 'performer',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'performer',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/create',
                            'defaults' => array(
                                'controller' => 'performer',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:performerId]',
                            'defaults' => array(
                                'controller' => 'performer',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:performerId]',
                            'defaults' => array(
                                'controller' => 'performer',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'searchJson' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/search/json',
                            'defaults' => array(
                                'controller' => 'performer',
                                'action'     => 'searchJson',
                            ),
                        ),
                    ),
                ),
            ),

// Performer Lineup
            'performerLineup' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/performerLineup',
                    'defaults' => array(
                        'controller' => 'performerLineup',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'performerLineup',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:lineupId]',
                            'defaults' => array(
                                'controller' => 'performerLineup',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:performerLineupId]',
                            'defaults' => array(
                                'controller' => 'performerLineup',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:performerLineupId]',
                            'defaults' => array(
                                'controller' => 'performerLineup',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'sortPerformanceSetSongs' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/songs/sort[/:performanceId]',
                            'defaults' => array(
                                'controller' => 'performerLineup',
                                'action'     => 'sortPerformanceSetSongs',
                            ),
                        ),
                    ),
                ),
            ),

// Performer Performance
            'performerPerformance' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/performerPerformance',
                    'defaults' => array(
                        'controller' => 'performerPerformance',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'performerPerformance',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:performanceId]',
                            'defaults' => array(
                                'controller' => 'performerPerformance',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:performerPerformance]',
                            'defaults' => array(
                                'controller' => 'performerPerformance',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:performerPerformance]',
                            'defaults' => array(
                                'controller' => 'performerPerformance',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'sortPerformanceSetSongs' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/songs/sort[/:performanceSetId]',
                            'defaults' => array(
                                'controller' => 'performerPerformance',
                                'action'     => 'sortPerformanceSetSongs',
                            ),
                        ),
                    ),
                ),
            ),

// Song
            'song' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/song',
                    'defaults' => array(
                        'controller' => 'song',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'song',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/create',
                            'defaults' => array(
                                'controller' => 'song',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:songId]',
                            'defaults' => array(
                                'controller' => 'song',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:songId]',
                            'defaults' => array(
                                'controller' => 'song',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'searchJson' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/search/json',
                            'defaults' => array(
                                'controller' => 'song',
                                'action'     => 'searchJson',
                            ),
                        ),
                    ),
                ),
            ),

// Source
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
                    'band' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/band[/:bandId][/:year]',
                            'defaults' => array(
                                'controller' => 'source',
                                'action'     => 'band',
                            ),
                        ),
                    ),
                    'detail' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'source',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/create[/:performanceId]',
                            'defaults' => array(
                                'controller' => 'source',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:sourceId]',
                            'defaults' => array(
                                'controller' => 'source',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:sourceId]',
                            'defaults' => array(
                                'controller' => 'source',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                ),
            ),
// User
            'user' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/user',
                    'defaults' => array(
                        'controller' => 'user',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'profile' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/profile[/:id]',
                            'defaults' => array(
                                'controller' => 'user',
                                'action'     => 'profile',
                            ),
                        ),
                    ),
                    'takelogin' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/takelogin',
                            'defaults' => array(
                                'controller' => 'user',
                                'action'     => 'takelogin',
                            ),
                        ),
                    ),
                    'takelogout' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/takelogout',
                            'defaults' => array(
                                'controller' => 'user',
                                'action'     => 'takeLogout',
                            ),
                        ),
                    ),
                ),
            ),
// Venue
            'venue' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/venue',
                    'defaults' => array(
                        'controller' => 'venue',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'detail' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/detail[/:id]',
                            'defaults' => array(
                                'controller' => 'venue',
                                'action'     => 'detail',
                            ),
                        ),
                    ),
                    'create' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/create',
                            'defaults' => array(
                                'controller' => 'venue',
                                'action'     => 'create',
                            ),
                        ),
                    ),
                    'edit' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/edit[/:venueId]',
                            'defaults' => array(
                                'controller' => 'venue',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/delete[/:venueId]',
                            'defaults' => array(
                                'controller' => 'venue',
                                'action'     => 'delete',
                            ),
                        ),
                    ),
                    'searchJson' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/search/json',
                            'defaults' => array(
                                'controller' => 'venue',
                                'action'     => 'searchJson',
                            ),
                        ),
                    ),
                ),
            ),

//////////
            'sourceByBandYear' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/source/band[/:id][/:year]',
                    'defaults' => array(
                        'controller' => 'source',
                        'action'     => 'band',
                    ),
                ),
            ),

            'default' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/default',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller' => 'index',
                        'action' => 'default',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'index' => 'DbEtreeOrg\Controller\IndexController',
            'user' => 'DbEtreeOrg\Controller\UserController',
            'comment' => 'DbEtreeOrg\Controller\CommentController',
            'place' => 'DbEtreeOrg\Controller\PlaceController',
            'venue' => 'DbEtreeOrg\Controller\VenueController',
            'performer' => 'DbEtreeOrg\Controller\PerformerController',
            'performer-alias' => 'DbEtreeOrg\Controller\PerformerAliasController',
            'band' => 'DbEtreeOrg\Controller\BandController',
            'lineup' => 'DbEtreeOrg\Controller\LineupController',
            'performance' => 'DbEtreeOrg\Controller\PerformanceController',
            'performance-set' => 'DbEtreeOrg\Controller\PerformanceSetController',
            'song' => 'DbEtreeOrg\Controller\SongController',
            'performance-set-song' => 'DbEtreeOrg\Controller\PerformanceSetSongController',
            'source' => 'DbEtreeOrg\Controller\SourceController',
            'checksum' => 'DbEtreeOrg\Controller\ChecksumController',
            'performer-lineup' => 'DbEtreeOrg\Controller\PerformerLineupController',
            'performer-performance' => 'DbEtreeOrg\Controller\PerformerPerformanceController',
            'band-alias' => 'DbEtreeOrg\Controller\BandAliasController',
            'link' => 'DbEtreeOrg\Controller\LinkController',
        ),
    ),

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
            'DbEtreeOrg\View\Strategy\UnauthorizedStrategy',
        ),
    ),

    'view_helpers' => array(
        'invokables' => array(
            'findEntity' => 'DbEtreeOrg\View\Helper\FindEntity',

            'inputVenue' => 'DbEtreeOrg\View\Helper\InputVenue',
            'inputPerformer' => 'DbEtreeOrg\View\Helper\InputPerformer',
            'inputBand' => 'DbEtreeOrg\View\Helper\InputBand',
            'inputSong' => 'DbEtreeOrg\View\Helper\InputSong',

            'listComments' => 'DbEtreeOrg\View\Helper\ListComments',
            'listLinks' => 'DbEtreeOrg\View\Helper\ListLinks',

            'findVenue' => 'DbEtreeOrg\View\Helper\FindVenue',
            'findPerformer' => 'DbEtreeOrg\View\Helper\FindPerformer',

            'createComment' => 'DbEtreeOrg\View\Helper\CreateComment',
            'createLink' => 'DbEtreeOrg\View\Helper\CreateLink',

            'pasteUpload' => 'DbEtreeOrg\View\Helper\PasteUpload',
        ),
    ),

    'di' => array(
        'instance' => array(
            'alias' => array(
                'menu' => 'DbEtreeOrg\Service\Menu',
            ),

            'Zend\Authentication\AuthenticationService' => array(
                'parameters' => array(
                    'storage' => 'DoctrineModule\Authentication\Storage\ObjectRepository',
 #                   'adapter' => 'User\Authentication\Adapter\AppleConnect',
                ),
            ),

            'DbEtreeOrg\Service\Menu' => array(
                'parameters' => array(
                    'servicemanager' => 'Zend\ServiceManager\ServiceManager',
                ),
            ),
        ),
    ),

);
