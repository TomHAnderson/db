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
            'takelogin' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/user/takelogin',
                    'defaults' => array(
                        'controller' => 'user',
                        'action'     => 'takelogin',
                    ),
                ),
            ),
            'logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/user/takelogout',
                    'defaults' => array(
                        'controller' => 'user',
                        'action'     => 'takelogout',
                    ),
                ),
            ),

            'default' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/[:controller[/][/:action]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'index',
                        'action' => 'index',
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
            'performance-song' => 'DbEtreeOrg\Controller\PerformanceSongController',
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
        ),
    ),

    'view_helpers' => array(
        'invokables' => array(
            'findEntity' => 'DbEtreeOrg\View\Helper\FindEntity',

            'inputVenue' => 'DbEtreeOrg\View\Helper\InputVenue',
            'inputPerformer' => 'DbEtreeOrg\View\Helper\InputPerformer',
            'inputBand' => 'DbEtreeOrg\View\Helper\InputBand',
            'inputSong' => 'DbEtreeOrg\View\Helper\InputSong',

            'addPerformerToLineup' => 'DbEtreeOrg\View\Helper\AddPerformerToLineup',
            'addPerformerToPerformance' => 'DbEtreeOrg\View\Helper\AddPerformerToPerformance',

            'removePerformerFromPerformance' => 'DbEtreeOrg\View\Helper\RemovePerformerFromPerformance',
            'removePerformerFromLineup' => 'DbEtreeOrg\View\Helper\RemovePerformerFromLineup',

            'listPerformances' => 'DbEtreeOrg\View\Helper\ListPerformances',

            'findVenue' => 'DbEtreeOrg\View\Helper\FindVenue',
            'findPerformer' => 'DbEtreeOrg\View\Helper\FindPerformer',

            'createComment' => 'DbEtreeOrg\View\Helper\CreateComment',
            'listComments' => 'DbEtreeOrg\View\Helper\ListComments',

            'createPerformerAlias' => 'DbEtreeOrg\View\Helper\CreatePerformerAlias',

            'createLink' => 'DbEtreeOrg\View\Helper\CreateLink',
            'listLinks' => 'DbEtreeOrg\View\Helper\ListLinks',
        ),
    ),

    'di' => array(
        'instance' => array(
        ),
    ),
);
