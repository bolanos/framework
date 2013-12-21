<?php
require_once __DIR__.'/autoload.php';
$config = require_once __DIR__.'/config.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Dependency injector
$container = new Library\Common\DependencyInjection();

$container['config'] = $config;

$container['database'] = $container->share(function ($container) {
	$isDevMode = true;
	$doctrineConfig = Setup::createAnnotationMetadataConfiguration([getcwd() . "/src"], $isDevMode);

	// Logger
	//$config->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger());

	return EntityManager::create($container['config']['database'], $doctrineConfig);
});