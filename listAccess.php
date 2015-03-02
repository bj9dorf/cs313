<!DOCTYPE html>
<html>
<head>
	<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
		<script src="js/bootstrap.js"></script>
</head>
<body>
	<?php 
	session_start();

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
	    	echo "In the openshift environment <br>";
		    $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
//				$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
			$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
			$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
		}

	
	$_POST['username'] = $_SESSION['username'];

	if (isset($_POST))
	{
		
		if (isset($_POST['username']))
		{

			echo "<nav class=\"navbar navbar-inverse\">
					<div class=\"container-fluid\">
				  	<div class=\"navbar-header\">
						<h4>User: " . $_POST['username'] . "
						</h4>
					</div>";
			$_SESSION['mainuser'] = $_POST['username'];
			$db = new PDO ("mysql:host=127.11.29.130;dbname=shoppingList",	$dbUser, $dbPassword);
			$sql = "SELECT userId FROM user WHERE username=:name";
			$stmt = $db->prepare($sql);
			$stmt->bindValue(':name', $_SESSION['mainuser']); 
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION['userId'] = $row['userId']; 
			}
		else
		{
			$_POST['username'] = $_SESSION['mainuser'];
			echo "User: " . $_POST['username'];
		}
	}
	else 
	{
		echo "FAIL!";
	}

	
	echo "<br>";
	echo "</div>
		  </nav>";

	echo "<h6>[Check the items or list you want to delete and click any button]<h6><br>";
	echo "<div class=\"bg-info\">";
	echo "<br><form action=\"updateList.php\" method=\"post\">";
	echo "<input type=\"text\" placeholder=\"New List\" name=\"listname\"><input type=\"submit\" class=\"btn btn-primary btn-xs active\" value=\"+\"><br>";

	try 
	{
		$query = $_POST['username'];
 		
		$db = new PDO ("mysql:host=127.11.29.130;dbname=shoppingList",	$dbUser, $dbPassword);
		$sql = "SELECT userId FROM user WHERE username=:name";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':name', $query, PDO::PARAM_STR);
		$stmt->execute();


		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			foreach ($db->query("SELECT listname, listId FROM list WHERE userId=\"" . $row["userId"] . "\"") as $row2)
			{
	   			echo "<div><input type=\"checkbox\" name=\"deleteList[]\" value=\"" . $row2['listname'] . "\">List name: " . $row2['listname'];
				echo "<div class=\"col-sm-2 control-label\">";
				foreach ($db->query("SELECT itemname FROM item WHERE listId=\"" . $row2["listId"] . "\"") as $row3)
				{
	   				echo "<input type=\"checkbox\" name=\"deleteItem[]\" value=\"" . $row3["itemname"] . "\"> Item: " . $row3['itemname'];					
		   			echo "<br>";
				}
				//creating input
				echo "<input type=\"text\" placeholder=\"Insert item...\" name=\"itemname[]\"><input type=\"submit\" class=\"btn btn-primary btn-xs active\" value=\"+\"><br>";
				echo "<input type=\"hidden\" name=\"listId[]\" value=\"" . $row2["listId"] . "\">";
				echo "</div>";
				echo "</div>";
			}
		}
		echo "</form><br>";
		echo "</div>";

	} 
	catch (PDOException $e) 
	{
		echo "Error: "	. $e->getMessage();
		die();
	}
	echo "<br><br><div>
	<a href=\"http://localhost/cs313testing/listLogout.php\">Logout and to login page</a>
	</div>";

	?>
</body>
</html>