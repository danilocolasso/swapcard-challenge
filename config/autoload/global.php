<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

$moduleRoot = __DIR__ . '/../../module';

function getEntityPaths($moduleRoot)
{
    $entityPaths = [];
    $modules = scandir($moduleRoot);

    foreach ($modules as $module) {
        if ($module === '.' || $module === '..') {
            continue;
        }

        $entityPath = $moduleRoot . '/' . $module . '/src/Entity';
        if (is_dir($entityPath)) {
            $entityPaths[] = $entityPath;
        }
    }

    return $entityPaths;
}

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => 'mysql:dbname=mydatabase;host=192.168.80.2;charset=utf8',
        'username' => 'myuser',
        'password' => 'mypassword',
    ],
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDO\MySQL\Driver::class,
                'params' => [
                    'host' => '192.168.80.2',
                    'port' => '3306',
                    'user' => 'myuser',
                    'password' => 'mypassword',
                    'dbname' => 'mydatabase',
                    'charset' => 'utf8',
                ],
            ],
        ],
        'driver' => [
            'default_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../../module/Email/src/Entity', // replace with the path to your entity classes
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'default_driver' => 'annotation_driver',
                    'Email\Entity' => 'default_driver',
                ],
            ],
            'annotation_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => getEntityPaths($moduleRoot),
            ],
        ],
        'entity_manager' => [
            'orm_default' => [
                'connection' => 'orm_default',
                'configuration' => [
                    'metadata_cache' => 'array',
                    'query_cache' => 'array',
                    'result_cache' => 'array',
                ],
            ],
        ],
    ],
];
