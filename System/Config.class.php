<?php

namespace System;

class Config {

	const KEY_SEPARATOR = '.';

	const PATH_SEPARATOR = '#';

	private static $configFilePath;

	private static $config;

	/**
	 * 获取配置
	 * @param string $key 以点表示数组层级的字符串 例如: system.plugins Plugin#mvc.path.controller（#表示目录层级，允许最多一个#）
	 * @return NULL|Ambigous <NULL, unknown>
	 */
	public static function get($key){
		$key = explode(self::KEY_SEPARATOR, $key);
		if (strpos($key[0], self::PATH_SEPARATOR) !== false){
			if (!isset(self::$config[$key[0]][$key[1]])){
				list($k0, $k1) = explode(self::PATH_SEPARATOR, $key[0]);
				$filename = $k0 . '/' . $k1 . '.conf.php';
				self::loadConfig($filename, $key[0]);
			}
		}elseif (!isset(self::$config[$key[0]])){
			$filename = $key[0] . '.conf.php';
			self::loadConfig($filename, $key[0]);
		}
		$result = null;
		$tmpConfig = self::$config;
		foreach ($key as $k){
			if (!isset($tmpConfig[$k])){
				return null;
			}
			$result = $tmpConfig = $tmpConfig[$k];
		}
		return $result;
	}

	public static function setConfigFilePath($path){
		if (!is_file($path)){
		}
		self::$configFilePath = rtrim($path, '/') . '/';
	}

	public static function loadConfig($filename, $aliasName, $overwrite = false){
		if (strpos($filename, '..')){
			// exception
		}
		$filename = self::$configFilePath . $filename;
		
		if (!is_file($filename) || !is_readable($filename)){
			// exception
		}
		if (!$overwrite && isset(self::$config[$aliasName])){
			// exception
		}
		self::$config[$aliasName] = include $filename;
	}
}