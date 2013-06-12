<?php

return array(
    'bjyauthorize' => array(

        // set the 'guest' role as default (must be defined in a role provider)
        'default_role' => 'guest',

        /* this module uses a meta-role that inherits from any roles that should
         * be applied to the active user. the identity provider tells us which
         * roles the "identity role" should inherit from.
         *
         * for ZfcUser, this will be your default identity provider
         */
        'identity_provider' => 'AppleConnect\Provider\Identity\AppleConnect',

        /* role providers simply provide a list of roles that should be inserted
         * into the Zend\Acl instance. the module comes with two providers, one
         * to specify roles in a config file and one to load roles using a
         * Zend\Db adapter.
         */
        'role_providers' => array(

            /* here, 'guest' and 'user are defined as top-level roles, with
             * 'admin' inheriting from user
             */
            'BjyAuthorize\Provider\Role\Config' => array(
                'guest' => array(),
                'user'  => array('children' => array(
                    'admin' => array(),
                )),
            ),
        ),

        // resource providers provide a list of resources that will be tracked
        // in the ACL. like roles, they can be hierarchical
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'pants' => array(),
            ),
        ),

        /* rules can be specified here with the format:
         * array(roles (array), resource, [privilege (array|string), assertion])
         * assertions will be loaded using the service manager and must implement
         * Zend\Acl\Assertion\AssertionInterface.
         * *if you use assertions, define them using the service manager!*
         */
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    // allow guests and users (and admins, through inheritance)
                    // the "wear" privilege on the resource "pants"
                    array(array('guest', 'user'), 'pants', 'wear')
                ),

                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
#                'deny' => array(
#                    // ...
#                ),
            ),
        ),

        /* Currently, only controller and route guards exist
         */
        'guards' => array(
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all controllers and actions unless they are specified here.
             * You may omit the 'action' index to allow access to the entire controller
             */
#            'BjyAuthorize\Guard\Controller' => array(
#                array('controller' => 'index', 'action' => 'index', 'roles' => array('guest','user')),
#                array('controller' => 'index', 'action' => 'stuff', 'roles' => array('user')),
#                array('controller' => 'zfcuser', 'roles' => array()),
                // Below is the default index action used by the [ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication)
                // array('controller' => 'Application\Controller\Index', 'roles' => array('guest', 'user')),
#            ),

            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
             */
            'BjyAuthorize\Guard\Route' => array(
                array('route' => 'home', 'roles' => array('guest')),
                array('route' => 'menu', 'roles' => array('guest')),

                array('route' => 'bandAlias', 'roles' => array('guest'));
                array('route' => 'bandAlias/detail', 'roles' => array('guest'));
                array('route' => 'bandAlias/create', 'roles' => array('user'));
                array('route' => 'bandAlias/edit', 'roles' => array('user'));
                array('route' => 'bandAlias/delete', 'roles' => array('admin'));

                array('route' => 'band', 'roles' => array('guest'));
                array('route' => 'band/detail', 'roles' => array('guest'));
                array('route' => 'band/create', 'roles' => array('user'));
                array('route' => 'band/edit', 'roles' => array('user'));
                array('route' => 'band/delete', 'roles' => array('admin'));
                array('route' => 'band/searchJson', 'roles' => array('user'));

                array('route' => 'checksum', 'roles' => array('guest'));
                array('route' => 'checksum/detail', 'roles' => array('guest'));
                array('route' => 'checksum/create', 'roles' => array('user'));
                array('route' => 'checksum/edit', 'roles' => array('user'));
                array('route' => 'checksum/delete', 'roles' => array('admin'));

                array('route' => 'comment', 'roles' => array('none'));
                array('route' => 'comment/create', 'roles' => array('user'));
                array('route' => 'comment/delete', 'roles' => array('user'));

                array('route' => 'lineup', 'roles' => array('none'));
                array('route' => 'lineup/detail', 'roles' => array('guest'));
                array('route' => 'lineup/create', 'roles' => array('user'));
                array('route' => 'lineup/edit', 'roles' => array('user'));
                array('route' => 'lineup/delete', 'roles' => array('admin'));
                array('route' => 'lineup/addPerformer', 'roles' => array('user'));
                array('route' => 'lineup/removePerformer', 'roles' => array('admin'));

                array('route' => 'link', 'roles' => array('none'));
                array('route' => 'link/create', 'roles' => array('user'));
                array('route' => 'link/edit', 'roles' => array('admin'));
                array('route' => 'link/delete', 'roles' => array('admin'));

                array('route' => 'performance', 'roles' => array('none'));
                array('route' => 'performance/detail', 'roles' => array('guest'));
                array('route' => 'performance/create', 'roles' => array('user'));
                array('route' => 'performance/edit', 'roles' => array('user'));
                array('route' => 'performance/delete', 'roles' => array('admin'));
                array('route' => 'performance/addPerformer', 'roles' => array('user'));
                array('route' => 'performance/removePerformer', 'roles' => array('admin'));

                // Below is the default index action used by the [ZendSkeletonApplication](https://github.com/zendframework/ZendSkeletonApplication)
                array('route' => 'application/default', 'roles' => array('none')),
            ),
        ),
    ),
);
