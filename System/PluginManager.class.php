<?php

namespace System;

class PluginManager {

	protected static $plugins = array();

	public static function registerPlugin(Plugin $plugin){
		self::$plugins[$plugin->getId()] = $plugin;
		MessageManager::registerListener($plugin);
	}
}