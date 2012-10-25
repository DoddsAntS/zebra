<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'payments\Controller\Payment' => 'payments\Controller\PaymentController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'payments' => __DIR__ . '/../view',
        ),
    ),
);