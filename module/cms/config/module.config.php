<?php
return array(
    'doctrine' => array(
        'orm_autoload_annotations' => true,

        'connection' => array(
            'orm_default' => array(
                'configuration' => 'orm_default',
                'eventmanager'  => 'orm_default',

                'params' => array(
                    'host'     => '127.0.0.1',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => 'MV87E977',
                    'dbname'   => 'cms8',
                )
            ),
        ),

        'configuration' => array(
            'orm_default' => array(
                'metadata_cache'    => 'array',
                'query_cache'       => 'array',
                'result_cache'      => 'array',

                'driver'            => 'orm_default',

                'generate_proxies'  => true,
                'proxy_dir'         => 'data/DoctrineORMModule/Proxy',
                'proxy_namespace'   => 'DoctrineORMModule\Proxy',
                'filters'           => array()
            )
        ),

        'driver' => array(
            'orm_default' => array(
                'class'   => 'Doctrine\ORM\Mapping\Driver\DriverChain',
                'drivers' => array('cms'=>'cms_driver'),
            ),
            'cms_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '../src/cms/Entity')
            )
        ),

        'entitymanager' => array(
            'orm_default' => array(
                'connection'    => 'orm_default',
                'configuration' => 'orm_default'
            )
        ),

        'eventmanager' => array(
            'orm_default' => array()
        ),

        'sql_logger_collector' => array(
            'orm_default' => array(),
        ),

        'entity_resolver' => array(
            'orm_default' => array()
        ),

        'authentication' => array(
            'orm_default' => array(
                'objectManager' => 'doctrine.entitymanager.orm_default',
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'blog' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/blog',
                    'defaults' => array(
                        '__NAMESPACE__' => 'cms\Controller',
                        'controller'    => 'Blog',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'cms\Controller',
                                'controller'    => 'Blog',
                            ),
                        ),
                    ),
                    'viewBlog' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/view[/:blogId][/:id][/:title]',
                            'constraints' => array(
                                'blogId' => '[0-9]+',
                                'id' => '[0-9]+',
                                'title' => '[a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'cms\Controller',
                                'controller'    => 'Blog',
                                'action'=>'view',
                                'blogId'=>0,
                                'id' => 0,
                                'title' => null
                            ),
                        )
                    ),
                    'listPage' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/list[/:blogId][/:page]',
                            'constraints' => array(
                                'blogId' => '[0-9]+',
                                'page' => '[0-9]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'cms\Controller',
                                'controller'    => 'Blog',
                                'action'=>'list',
                                'blogId'=>0,
                                'page' => 0,
                            ),
                        )
                    ),
                ),
            ),
            'page' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/page',
                    'defaults' => array(
                        '__NAMESPACE__' => 'cms\Controller',
                        'controller'    => 'Page',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'cms\Controller',
                                'controller'    => 'Page',
                            ),
                        ),
                    ),
                    'viewUser' => array(
                        'type'=>'segment',
                        'options'=> array(
                            'route'=>'/view[/:id]',
                            'constraints'=>array('[0-9]*'),
                        ),
                        'defaults'=>array(
                            '__NAMESPACE__'=>'cms\Controller',
                            'controller'=>'Page',
                            'action'=>'index',
                            'id'=>0
                        )
                    )
                ),
            ),
            'account' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/account',
                    'defaults' => array(
                        '__NAMESPACE__' => 'cms\Controller',
                        'controller'    => 'Account',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'cms\Controller',
                                'controller'    => 'Account',
                            ),
                        ),
                    ),
                    'viewUser' => array(
                        'type'=>'segment',
                        'options'=> array(
                            'route'=>'/view[/:id]',
                            'constraints'=>array('[0-9]*'),
                        ),
                        'defaults'=>array(
                            '__NAMESPACE__'=>'cms\Controller',
                            'controller'=>'Account',
                            'action'=>'view',
                            'id'=>0
                        )
                    )
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'cms\Controller\Page' => 'cms\Controller\PageController',
            'cms\Controller\Blog' => 'cms\Controller\BlogController',
            'cms\Controller\Account' => 'cms\Controller\AccountController',
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
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
