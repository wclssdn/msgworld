<?php

namespace Plugin\System;

use System\Message;

class RouterMessage extends Message {

	private $c;

	private $a;

	public function __construct($c, $a){
		$this->c = $c . 'Controller';
		$this->a = $a . 'Action';
	}

	public function getControllerName(){
		return $this->c;
	}

	public function getActionName(){
		return $this->a;
	}
}