<?php

namespace Email;

use Doctrine\ORM\EntityManagerInterface;
use Email\Entity\Profile;
use Email\Service\ProfileService;
use Laminas\Router\Http\Method;
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
            Controller\EmailController::class =>
                fn($container) => new Controller\EmailController($container->get(ProfileService::class),
                ),
            ProfileService::class =>
                fn($container) => new ProfileService(
                    $container->get(EntityManagerInterface::class)->getRepository(Profile::class)
                )
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'email/email/index' => __DIR__ . '/../view/email/index/index.phtml',
            'email/email/list' => __DIR__ . '/../view/email/list/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];