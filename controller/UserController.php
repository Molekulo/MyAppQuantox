<?php
namespace App;

class UserController
{
	public static function checkUser()
	{
		Session::start();
		if (Session::get('user')) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function index()
	{
		if (isset($_GET['page'])) {
			$method = $_GET['page'];
		} else {
			$method = 'home';
		}
		// provera metode koja omogucava pretrazivanje
		if (isset($_GET['q'])) {
			$q = $_GET['q'];
		} else {
			$q = null;
		}
		
		if (method_exists("App\UserController", $method)) {
			static::$method($q);
		} else {
			static::home();
		}
	}

	public static function home()
	{
		if (static::checkUser()) {
			static::login();
		} else {
			include "view/home.php";
		}
	}

	public static function login()
	{
		if (static::checkUser()) {
			static::home();
		} else {
			include "view/login.php";
			if ($_POST) {
				$email = htmlentities($_POST['email']);
				$pass = sha1($_POST['pass']);
				Session::start();
				$getEmail = UserModel::execute('getEmail', $email);
				$getPass = UserModel::execute('getPass', $pass);
				$getUser = UserModel::execute('getUserByEmail', $email);
				$user = $getUser->fetch_object();
				if ($getEmail->num_rows >= 1 && $getPass->num_rows >= 1 ) {
					Session::set('user', $user->username);
					header("Location: index.php?page=home");
				} else {
					echo "<p>Error loging you in!</p>";
				}
			}
		}
	}

	public static function logout()
	{
		if (static::checkUser()) {
			Session::delete('user');
			echo "<h1>Logout Success!</h1><br>";
		} else {
			echo "<h1>Login</h1><br>";
		}
		static::login();
	}

	public static function register()
	{
		if (static::checkUser()) {
			echo "<h1>Already registered!</h1><br>";
			static::home();
		} else {
			echo "<h1>Register</h1><br>";
			include "view/register.php";
			if ($_POST) {
				$user = htmlspecialchars($_POST['user']);
				$email = htmlentities($_POST['email']);
				$pass = sha1($_POST['pass']);
				$pass2 = sha1($_POST['pass2']);
				$tempEmail = UserModel::execute('getEmail', $email);
				$tempUser = UserModel::execute('getUser', $user);

				if ( $user == '' || $email == '' || $pass =='' || $pass2 =='') {
					echo "You must enter all fields!";				
				} else if ($pass != $pass2) {
					echo "Passwords don't match!Try again";
				} else if ($tempEmail == 1 || $tempUser == 1) {
					echo "Email or username already exists in database. Try other email or username!";
				} else {
					$registerUser = UserModel::execute('registerUser', $user, $email, $pass);
					if ($registerUser) {
						echo "Success registration! Now you can login";
					} else {
						echo "Error, wrong registration";
					}
				}
			}
		}
	}

	public static function search($q)
	{
		if (static::checkUser()) {
			$row = UserModel::execute('search', \htmlentities($q));
			include "view/result.php";
		} else {
			echo "<h1>You must login to search!</h1><br>";
			static::login();
		}	
	}
}