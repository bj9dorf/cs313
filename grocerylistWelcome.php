<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<h1>Welcome</h1>
<p>Please Login</p>
	<?php 
		try 
		{
			$user = "bruce";
			$password = "brucepass";
			$db   = new PDO("mysql:host=localhost;dbname=shoppingList", $user, $password);
		}
		catch (PDOException $ex)
		{
			echo "Error!: " . $ex->getMessage();
			die(); 
		}

		echo '<form action="listAccess.php" method="post"	>';
		echo '<div>';
		echo '<select name="user">';
		foreach ($db->query("SELECT username FROM user") as $row)
		{
	   		echo '<option value='. $row['username'] . '>' . $row['username'] . '</option>';
		}
		echo '</select> ';
		echo '<input type="submit" name="submit" values="Submit" <br><br>';
		echo '</div> <br>';
		echo '</form>';

	?>
</body>
</html>