<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
return array(
    'doctrine' => array(
        'orm_autoload_annotations' => true,

        'connection' => array(
            'orm_default' => array(
                'configuration' => 'orm_default',
                'eventmanager' => 'orm_default',

                'params' => array(
                    'host' => '127.0.0.1',
                    'port' => '3306',
                    'user' => '',
                    'password' => '',
                    'dbname' => '',
                )
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            /**
             * This default Db factory is required so that ZDT 
             * doesn't throw exceptions, even though we don't use it
             */
            'Zend\Db\Adapter\Adapter' => function ($sm) {
                $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter(array(
                            'driver' => 'pdo',
                            'dsn' => 'mysql:dbname=;host=127.0.0.1',
                            'database' => '',
                            'username' => '',
                            'password' => '',
                            'hostname' => '127.0.0.1',
                        ));

                $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler);
                $adapter->injectProfilingStatementPrototype();
                return $adapter;
            },
        ),
    ),
    'zenddevelopertools' => array(
        'profiler' => array(
            'collectors' => array(
                'orm_default' => 'doctrine.sql_logger_collector.orm_default',
            ),
        ),
        'toolbar' => array(
            'entries' => array(
                'orm_default' => 'zend-developer-tools/toolbar/doctrine-orm',
            ),
        ),
    ),
);
?>
