<?php
namespace App;

class UserModel
{
	public static function execute($method, $param1 = null, $param2 = null, $param3 = null)
	{
		$conn = Database::connect();
		$row = $conn->query(static::$method($param1, $param2, $param3));
		return $row;
	}
	
	public static function search($data)
	{
		$query = "SELECT username, email FROM users WHERE username = \"$data\" OR email = \"$data\"";
		return $query;
	}

	public static function getEmail($email)
	{
		$query = "SELECT email FROM users WHERE email = \"$email\"";
		return $query;
	}

	public static function getUserByEmail($email)
	{
		$query = "SELECT username FROM users WHERE email = \"$email\"";
		return $query;
	}

	public static function getUser($user)
	{
		$query = "SELECT username FROM users WHERE username = \"$user\"";
		return $query;
	}

	public static function getPass($pass)
	{
		$query = "SELECT password FROM users WHERE password = \"$pass\"";
		return $query;
	}

	public static function registerUser($user, $email, $pass)
	{
		$query = "INSERT INTO users (username, email, password) VALUES (\"$user\" , \"$email\", \"$pass\")";
		return $query;
	}
}