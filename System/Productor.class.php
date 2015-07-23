<?php

namespace System;

/**
 * 消息监听者
 * @author wangchenglong
 */
interface Productor {

	/**
	 * 生产消息
	 * @param Message $msg
	 */
	public function product(Message $msg);
}