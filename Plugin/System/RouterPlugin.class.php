<?php

namespace Plugin\System;

use \System\Plugin;
use \Plugin\System\RequestMessage;
use \Plugin\System\RouterMessage;

class RouterPlugin extends Plugin {

	protected $acceptMessageTypes = array(
		'Plugin\System\RequestMessage'
	);

	/*
	 * (non-PHPdoc) @see \System\Plugin::getId()
	 */
	public function getId(){
		return 'router';
	}

	/*
	 * (non-PHPdoc) @see \System\Plugin::work()
	 */
	public function work(\System\Message $msg){
		if (!$msg instanceof RequestMessage){
			return false;
		}
		$c = isset($_GET['c']) ? $_GET['c'] : 'Index';
		$a = isset($_GET['a']) ? $_GET['a'] : 'index';
		$this->product(new RouterMessage($c, $a));
	}
}