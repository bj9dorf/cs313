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
		$query = $_POST['user']; //These commented out parts are in place for future searching

 		$user = "bruce";
		$pass = "brucepass";

		$db = new PDO ("mysql:host=127.0.0.1;dbname=shoppingList",	$user, $pass);
		$sql = "SELECT userId FROM user WHERE username=:name";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':name', $query, PDO::PARAM_STR);
		$stmt->execute();

		echo "<br>";
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			foreach ($db->query("SELECT listname, listId FROM list WHERE userId=\"" . $row["userId"] . "\"") as $row2)
			{
	   			echo "List name: " . $row2['listname'];
				echo "<br />";
				foreach ($db->query("SELECT itemname FROM item WHERE listId=\"" . $row2["listId"] . "\"") as $row3)
				{
	   				echo " -- Item: " . $row3['itemname'];
					echo "<br />";
				}
			}
		}

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