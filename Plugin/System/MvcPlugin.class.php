<?php

namespace Plugin\System;

use System\Plugin;
use System\Config;

class MvcPlugin extends Plugin {

	protected $acceptMessageTypes = array(
		'\Plugin\System\RouterMessage'
	);

	/*
	 * (non-PHPdoc) @see \System\Plugin::work()
	 */
	public function work(\System\Message $msg){
		$controllerFilePath = Config::get('Plugin#mvc.path.controller');
		$controllerClass = '\Web\\' . $msg->getControllerName();
		$controller = new $controllerClass();
		$action = $msg->getActionName();
		$controller->$action();
	}

	/*
	 * (non-PHPdoc) @see \System\Plugin::getId()
	 */
	public function getId(){
		return 'mvc';
	}
}