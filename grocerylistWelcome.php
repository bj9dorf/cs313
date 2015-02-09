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
			$openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
			$dbName = "shoppingList";
			if ($openShiftVar === null || $openShiftVar == "")
			{
			     // Not in the openshift environment
			    $dbHost = "127.11.29.130";
//   				$dbPort = "";
     			$dbUser = "bruce"; //trying to get openshift to work
				$dbPassword = "brucepass";
				
			     // …
			}
			else 
			{
			     // In the openshift environment 
			    $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
//				$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
				$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
				$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
			}

			$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
//			echo "host:$dbHost dbName:$dbName user:$dbUser password:$dbPassword<br />\n";
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