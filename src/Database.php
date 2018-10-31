<?php
namespace App;

require 'params.php';

class Database
{
	private static $conn;

	public static function connect()
	{
		if (!self::$conn) {
			self::make();
		}
		return self::$conn;
	}
		
	public static function make()
	{
		self::$conn = new \mysqli(HOST, USER, PASS, DB);
		return self::$conn;
	}

	private function __construct()
	{

	}

	private function __clone()
	{
		
	}
}