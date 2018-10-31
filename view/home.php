<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>
</head>
<body>
<?php
if (App\Session::get('user') !== null) {
    echo "<h1>Welcome " . App\Session::get('user') . "</h1>";
}
?>
<h1>Home page</h1>
<h2>Search by e-mail or username</h2>
<form method="GET" action="index.php?page=result">
	<input type="" name="page" value='search' hidden="true">
	Search e-mail or username : <input type="text" name="q">
	<input type="submit" value="Submit">
</form>

<?php
if (App\Session::get('user') !== null) : ?> 
    <a href="index.php?page=logout"><button>Logout</button></a>
<?php else : ?>
<a href="index.php?page=login"><button>Login</button></a>
<a href="index.php?page=register"><button>Register</button></a>
<?php endif ?>
</body>
</html>



