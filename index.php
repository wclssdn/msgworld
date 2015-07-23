<?php
define('PATH_ROOT', __DIR__ . '/');
ini_set('display_errors', 1);
error_reporting(E_ALL);

use System\Config;
use System\PluginManager;
use System\Autoloader;
use System\MessageManager;
use Plugin\System\RequestMessage;

require PATH_ROOT . 'System/Autoloader.class.php';

$autoload = new Autoloader(PATH_ROOT);
$autoload->register();

Config::setConfigFilePath(PATH_ROOT . 'Config');
$pluginsConfig = Config::get('system.plugins');

foreach ($pluginsConfig as $pluginConfig){
	$plugin = new $pluginConfig['className']();
	PluginManager::registerPlugin($plugin);
}

MessageManager::add(new RequestMessage());