<?php

/**
 * My Application bootstrap file.
 */

use Nette\Diagnostics\Debugger;
use Nette\Environment;
use Nette\Application\Routers\Route;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
//use Nette\Application\Routers\RouteList;

// Load Nette Framework
require LIBS_DIR . '/autoload.php';

$configurator = new Nette\Config\Configurator;

// Enable Nette Debugger for error visualisation & logging
$configurator->setDebugMode(TRUE);
$configurator->enableDebugger(__DIR__ . '/../log');

// Enable RobotLoader - this will load all classes automatically
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->addDirectory(LIBS_DIR)
	->addDirectory(APP_DIR)
	->register();

// Load configuration from config.neon file
$configurator->addConfig(APP_DIR . '/config/config.neon');

$config = new Doctrine\ORM\Configuration; // (2)

// Doctrine 2 Debug Panel
$config->setSQLLogger(\Nella\Addons\Doctrine\Diagnostics\ConnectionPanel::register());

// Proxy Configuration (3)
$config->setProxyDir(APP_DIR . '/Doctrine/Proxies');
$config->setProxyNamespace('Yetti\Proxies');
$config->setAutoGenerateProxyClasses(!Environment::isProduction());

// Mapping Configuration (4)
//$driverImpl = new \Doctrine\ORM\Mapping\Driver\YamlDriver(dirname(__FILE__) . '/doctrine/schema');
//$config->setMetadataDriverImpl($driverImpl);

// Caching Configuration (5)
if (!Environment::isProduction()) {
	$cache = new \Doctrine\Common\Cache\ArrayCache();
} else {
	$cache = new \Doctrine\Common\Cache\ApcCache();
}
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

// TODO: Setup from 'Environment' config.neon
// Obtaining the entity manager (7)
$doctrineConfig = Setup::createAnnotationMetadataConfiguration(
	array(APP_DIR . '/Doctrine/Entities'), 	// directories with entities
	TRUE, 									// development mode
	APP_DIR . '/Doctrine/Proxies' 			// proxies directory
);

$conn = array(
	'driver'	=> 'pdo_mysql',
	'user'		=> 'root',
	'password'	=> 'lamp',
	'host'		=> 'localhost',
	'dbname'	=> 'yetti',
	'charset'	=> 'utf8',
	'collation'	=> 'utf8_czech_ci',
	'lazy'		=> 'true'		
);

$eventManager = new Doctrine\Common\EventManager();
$entityManager = EntityManager::create($conn, $doctrineConfig, $eventManager);

// Create container and run application
$container = $configurator->createContainer();
$container->application->run();


//dump($container->parameters['database']);

//$database = Environment::getConfig('database');
//Environment::getContext()->addService('Doctrine\ORM\EntityManager', $entityManager);
//Environment::getContext()->addService('doctrine', $entityManager);

// Configure application
//$application = Environment::getApplication();
//$application->errorPresenter = 'Error';
//$application->catchExceptions = TRUE;

//return $container;