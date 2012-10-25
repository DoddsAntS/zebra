<?php

return array(
    'zenddevelopertools' => array(
        /**
         * General Profiler settings
         */
        'profiler' => array(
            'enabled' => true,
            'strict' => false,
            'flush_early' => false,
            'cache_dir' => 'data/cache',
            'matcher' => array(),
            'collectors' => array(),
        ),
        /**
         * General Toolbar settings
         */
        'toolbar' => array(
            'enabled' => true,
            'auto_hide' => false,
            'position' => 'bottom',
            'version_check' => true,
            'entries' => array(),
        ),
    ),
);