<?php

declare(strict_types=1);

use Laminas\ServiceManager\ServiceManager;

// Load configuration
$config = require __DIR__ . '/config.php';

$dependencies = $config['dependencies'];
$dependencies['services']['config'] = $config;

$connection = \Doctrine\DBAL\DriverManager::getConnection($config['db']);
$dependencies['services']['db'] = $connection;

// Build container
return new ServiceManager($dependencies);
