<?php

namespace Email;

use Email\Controller\EmailController;
use Email\Controller\EmailControllerFactory;
use Laminas\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'email' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/email[/:action]',
                    'defaults' => [
                        'controller' => Controller\EmailController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            EmailController::class => EmailControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'email/email/index' => __DIR__ . '/../view/email/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];