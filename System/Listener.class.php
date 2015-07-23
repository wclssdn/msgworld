<?php

namespace System;

/**
 * 消息监听者
 * @author wangchenglong
 */
interface Listener {

	/**
	 * 是否可处理消息
	 * @param Message $msg
	 * @return boolean
	 */
	public function accept(Message $msg);

	/**
	 * 处理消息
	 * @param Message $msg
	 * @return boolean
	 */
	public function receive(Message $msg);
}