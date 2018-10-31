<?php
namespace App;

class Session
{
	private static $instance;

	public static function start() 
	{
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct()
	{
		session_start();
	}

	public static function get($key)
	{
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
	}

	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public static function delete($key)
	{
		$_SESSION[$key] = null;
	}

	private function __clone()
	{ 

	}
}