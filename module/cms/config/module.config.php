<?php
return array(
    'doctrine' => array(
        'orm_autoload_annotations' => true,

        'connection' => array(
            'orm_default' => array(
                'configuration' => 'orm_default',
                'eventmanager'  => 'orm_default',
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
                'paths' => array(__DIR__ . '\..\src\cms\Entity')
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
            'pageHtml' => array(
                'type' => 'regex',
                'options' => array(
                    'regex' => '/(?<page>[a-zA-Z0-9_-]+)(\.(?<format>(json|html|htm|xml|rss)))?',
                    'defaults' => array (
                        '__NAMESPACE__' => 'cms\Controller',
                        'controller' => 'Page',
                        'action'=>'index',
                        'format'=>'html'
                    ),
                    'spec' => '%page%.%format%'
                )
            ),
            'default' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/:controler[/:action[/:id]]',
                    'constraints' => array(
                        'controller'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'cms\Controller',
                        'controller' => 'Index',
                        'action' => 'index'
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
                    'viewPage' => array(
                        'type'=>'segment',
                        'options'=> array(
                            'route'=>'/view[/:page]',
                            'constraints'=> array(
                                'page' => '[a-zA-Z0-9_-]*'
                            ),
                        ),
                        'defaults'=>array(
                            '__NAMESPACE__'=>'cms\Controller',
                            'controller'=>'Page',
                            'action'=>'index',
                            'page'=>'home'
                        )
                    ),
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
                            'constraints'=> array(
                                    'id' => '[0-9]*'
                                ),
                            'defaults'=>array(
                                '__NAMESPACE__'=>'cms\Controller',
                                'controller'=>'Account',
                                'action'=>'view',
                                'id'=>0
                            )
                        ),
                    ),
                    'viewProfile' => array(
                        'type'=>'segment',
                        'options'=> array(
                            'route'=>'/profile[/:id]',
                            'constraints'=>array(
                                    'id'=>'[0-9]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'cms\Controller',
                                'controller'    => 'Account',
                                'action'=>'profile',
                                'id' => 0,
                            ),
                        ),
                    ),
                ),
            ),
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
            'news' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/news',
                    'defaults' => array(
                        '__NAMESPACE__' => 'cms\Controller',
                        'controller'    => 'News',
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
                                'controller'    => 'News',
                            ),
                        ),
                    ),
                    'view' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/view[/:id][/:title]',
                            'constraints' => array(
                                'id' => '[0-9]+',
                                'title' => '[a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'cms\Controller',
                                'controller'    => 'News',
                                'action'=>'view',
                                'id' => 0,
                                'title' => null
                            ),
                        )
                    ),
                    'comment' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/comment[/:newsId]',
                            'constraints' => array(
                                'newsId' => '[0-9]+',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'cms\Controller',
                                'controller'    => 'News',
                                'action'=>'comment',
                                'newsId'=>0,
                            ),
                        )
                    )
                ),
            ),
            'forum' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/forum',
                    'defaults' => array(
                        '__NAMESPACE__' => 'cms\Controller',
                        'controller'    => 'Forum',
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
                                'controller'    => 'Forum',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'cms\Controller\Blog' => 'cms\Controller\BlogController',
            'cms\Controller\Account' => 'cms\Controller\AccountController',
            'cms\Controller\Page' => 'cms\Controller\PageController',
            'cms\Controller\News' => 'cms\Controller\NewsController',
            'cms\Controller\Forum' => 'cms\Controller\ForumController',
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
