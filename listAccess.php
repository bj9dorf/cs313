<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 

	if (isset($_POST))
	{
		if (isset($_POST['user']))
		{
			echo "User: " . $_POST['user'];
		}
		else
		{
			echo 'FAILED AGAIN!';
		}
	}
	else 
	{
		echo "FAIL!";
	}
	
	try 
	{
//		$query = ""; //These commented out parts are in place for future searching

 		$user = "bruce";
		$pass = "brucepass";

		$db = new PDO ("mysql:host=127.0.0.1;dbname=shoppingList",	$user, $pass);
		
/*		$sql = "SELECT name FROM user WHERE name=:name";

		$statment = $db->prepare($sql);
		$statment->bindValue(':name', $query, PDO::PARAM_STR);
		$statement->execute();
*/
		$sql = "SELECT userId FROM user WHERE username=\'" . $_POST['user']. "\'";
		$stmt = $db->query($sql);

		$id = $stmt->fetch(PDO::FETCH_NUM);

		echo "<br>";
		foreach ($db->query("SELECT listname FROM list WHERE userId=\"" . $stmt->fetch(PDO::FETCH_NUM) . "\"") as $row)
		{
	   		echo "List name: " . $row['listname'];
			echo "<br />";
		}

/*		while ($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			echo "Found: " . $row["name"] . "<br />\n";
		}
*/
	} 
	catch (PDOException $e) 
	{
		echo "Error: "	. $e->getMessage();
		die();
	}

	echo "
	<div>
	<a href=\"http://localhost/cs313testing/grocerylistWelcome.php\">Back to login page</a>
	</div>
	";

	?>
</body>
</html>