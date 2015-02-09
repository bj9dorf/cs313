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
		$query = $_POST['user']; 

			$openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
			$dbName = "shoppingList";
			if ($openShiftVar === null || $openShiftVar == "")
			{
			     echo "Not in the openshift environment";
			    $dbHost = "127.11.29.130";
//   				$dbPort = "";
     			$dbUser = "bruce"; //trying to get openshift to work
				$dbPassword = "brucepass";
				
			     // …
			}
			else 
			{
		    	echo "In the openshift environment";
			    $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
//				$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
				$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
				$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
			}

			$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
		
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
	<a href=\"http://php-bniendorf.rhcloud.com/grocerylistWelcome.php\">Back to login page</a>
	</div>
	";

	?>
</body>
</html>