<?php

namespace System;

class Message {
	protected $async = false;
	public function setAsync() {
		$this->async = true;
	}
	public function getData(){
		
	}
}