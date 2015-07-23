<?php

namespace System;

class Autoloader
{

	private $paths = array();

	private $suffix = '.class.php';

	public function __construct($rootPath)
	{
		$this->rootPath = rtrim($rootPath, '/') . '/';
	}

	public function setSuffix($suffix)
	{
		$this->suffix = $suffix;
	}

	public function addPath($path)
	{
		if (file_exists($path))
		{
			$this->paths[] = rtrim($path, '/') . '/';
		}
	}

	public function load($className)
	{
		if (strpos($className, '\\'))
		{
			$paths = explode('\\', $className);
			$filename = '';
			$filePath = array();
			$i = 0;
			$n = count($paths);
			foreach ($paths as $path)
			{
				if (++$i == $n)
				{
					$filename = $path . '.class.php';
				}
				else
				{
					$filePath[] = $path;
				}
			}
			$filename = $this->rootPath . implode('/', $filePath) . '/' . $filename;
			if (is_file($filename))
			{
				include $filename;
			}
		}
		else
		{
			foreach ($this->paths as $path)
			{
				$filename = $path . $className . $this->suffix;
				if (is_file($filename))
				{
					include_once $filename;
				}
			}
		}
	}

	public function register()
	{
		spl_autoload_register(array($this, 'load'));
	}

}