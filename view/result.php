<h1>Search by e-mail or username</h1>
<form method="GET" action="">
	<input type="" name="page" value='search' hidden="true">
	Search e-mail or username : <input type="text" name="q">
	<input type="submit">
</form>
Results:<br>
<?php
if ($row->num_rows == 0) {
	echo "No result for <strong>$q</strong>";
} else {
	while ($red = $row->fetch_object()) {
		if (strtolower($red->username) == strtolower($q)) {
			echo "User exists for username {$q} and e-mail address is {$red->email}<br>";
		}
		if ($red->email == $q) {
			echo "E-mail exists for e-mail {$q} and username is {$red->username}<br>";
		}
	}
}
?><br>
<a href="index.php?page=home"><button>Home page</button></a>
<a href="index.php?page=logout"><button>Logout</button></a>