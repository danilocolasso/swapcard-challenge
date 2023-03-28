<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Laminas\Mvc\Application;
use Laminas\Stdlib\ArrayUtils;

require_once __DIR__ . '/vendor/autoload.php';

// Get application configuration
$config = require 'config/application.config.php';

// Create Laminas application
$app = Application::init($config);

// Retrieve the Entity Manager from the application service manager
$entityManager = $app->getServiceManager()->get('doctrine.entitymanager.orm_default');

// Create the helper set for ConsoleRunner
$helperSet = ConsoleRunner::createHelperSet($entityManager);
ConsoleRunner::createApplication($helperSet);

return $helperSet;