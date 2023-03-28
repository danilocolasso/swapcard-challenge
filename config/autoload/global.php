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
    'doctrine' => [
        'driver' => [
            'default_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../module/Email/src/Entity/']
            ],
            'orm_default' => [
                'drivers' => [
                    'default_driver' => 'annotation_driver',
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
