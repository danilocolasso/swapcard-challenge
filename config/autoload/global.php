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

if (!function_exists('getModules')) {
    function getModules($moduleRoot)
    {
        $modules = scandir($moduleRoot);

        foreach ($modules as $module) {
            if ($module === '.' || $module === '..') {
                continue;
            }

            $entityPath = $moduleRoot . '/' . $module . '/src/Entity';

            if (is_dir($entityPath)) {
                yield $module;
            }
        }
    }
}

if (!function_exists('getEntityPaths')) {
    function getEntityPaths($moduleRoot)
    {
        $entityPaths = [];

        foreach (getModules($moduleRoot) as $module) {
            $entityPaths[$module] = $moduleRoot . '/' . $module . '/src/Entity';;
        }

        return $entityPaths;
    }
}

if (!function_exists('getEntityDrivers')) {
    function getEntityDrivers($moduleRoot)
    {
        $entityDrivers = [];

        foreach (getModules($moduleRoot) as $module) {
            $entityDrivers[$module . '\Entity'] = 'default_driver';
        }

        return $entityDrivers;
    }
}

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDO\MySQL\Driver::class,
                'params' => [
                    'host' => getenv('DB_HOST'),
                    'port' => getenv('DB_PORT'),
                    'user' => getenv('DB_USER'),
                    'password' => getenv('DB_PASSWORD'),
                    'dbname' => getenv('DB_DATABASE'),
                    'charset' => getenv('DB_CHARSET'),
                ],
            ],
        ],
        'driver' => [
            'default_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => getEntityPaths($moduleRoot),
            ],
            'orm_default' => [
                'drivers' => array_merge([
                    'default_driver' => 'default_driver',
                ], getEntityDrivers($moduleRoot)),
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
