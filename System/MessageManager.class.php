<?php

namespace System;

use \System\Listener;

class MessageManager {

	private static $listener = array();

	public static function add(Message $msg){
		self::notify($msg);
	}

	public static function registerListener(Listener $listener){
		self::$listener[] = $listener;
	}

	private static function notify(Message $msg){
		foreach (self::$listener as $listener){
			if ($listener->accept($msg)){
				$listener->receive($msg);
			}
		}
	}
}