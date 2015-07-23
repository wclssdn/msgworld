<?php

namespace System;

use \System\Message;

abstract class Plugin implements Listener, Productor {

	/**
	 * 可处理的消息类型
	 * @var Message
	 */
	protected $acceptMessageTypes = array();

	/**
	 * 获取插件ID
	 * @return string
	 */
	abstract function getId();

	abstract function work(Message $msg);

	/*
	 * (non-PHPdoc) @see \System\Listener::accept()
	 */
	public function accept(Message $msg){
		foreach ($this->acceptMessageTypes as $messageType){
			if (is_a($msg, $messageType)){
				return true;
			}
		}
		return false;
	}

	/*
	 * (non-PHPdoc) @see \System\Listener::receive()
	 */
	public function receive(\System\Message $msg){
		if ($this->accept($msg)){
			$this->work($msg);
		}
	}

	/*
	 * (non-PHPdoc) @see \System\Productor::product()
	 */
	public function product(\System\Message $msg){
		MessageManager::add($msg);
	}
}