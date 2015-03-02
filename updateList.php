<?php

session_start();

$item = "";
$list = "";
$listId = "";
$deleteListSet = 0;
$deleteItemSet = 0;
if (isset($_POST["itemname"]))
{
	$item = $_POST['itemname'];
}
if (isset($_POST["listname"]))
{
	$list = $_POST['listname'];
}
if (isset($_POST["listId"]))
{
	$listId = $_POST['listId'];
}

if (isset($_POST["deleteList"]))
{
	$deleteListArray = $_POST['deleteList'];
	$deleteListSet = 1;
}
if (isset($_POST["deleteItem"]))
{
	$deleteItemArray = $_POST['deleteItem'];
	$deleteItemSet = 1;
}

if (!isset($item) || !isset($list))
{
	echo"I am... dying...I left all...the gold in the...-";
	die(); 
}

	$openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$dbName = "shoppingList";
	if ($openShiftVar === null || $openShiftVar == "")
	{
	     echo "Not in the openshift environment";
	    $dbHost = "127.11.29.130";
//  		$dbPort = "";
   		$dbUser = "bruce"; //trying to get openshift to work
		$dbPassword = "brucepass";
				
	}
	else 
	{
	   	echo "In the openshift environment <br>";
	    $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
//			$dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
		$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	}

$query = "";
try
{
	// Create the PDO connection
	$db = new PDO ("mysql:host=127.11.29.130;dbname=shoppingList",	$dbUser, $dbPassword);

	// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	if ($deleteListSet == 1)
	{
		foreach ($deleteListArray as $row)
		{	
			$query = "DELETE FROM list WHERE listname=\"" . $row . "\";";
			$statement = $db->prepare($query);
			$statement->execute();
		}
	}

	if ($deleteItemSet == 1)
	{
		foreach ($deleteItemArray as $row)
		{	
			$query = "DELETE FROM item WHERE itemname=\"" . $row . "\";";
			$statement = $db->prepare($query);
			$statement->execute();
		}
	}


	if ($list != "")
	{
		$query = "INSERT INTO list(userId, listname) VALUES(". $_SESSION['userId'] .",\"" . $list . "\");";
		echo $query . "<br>";
		$statement = $db->prepare($query);
		$statement->execute();
	}
	
	$query = "INSERT INTO item(listid, itemname) VALUES ";
	$reallySet = 0;
	for ($i=0, $count = count($item); $i<$count; $i++)
	{	
		if ($item[$i] != "")
		{
			$query = $query . "(" . $listId[$i] . ",\"" . $item[$i] . "\");";
			$reallySet = 1;
		}
	}
	if ($reallySet == 1)
	{
		echo $query . "<br>";
		$statement = $db->prepare($query);
		$statement->execute();
	}
}    
catch (Exception $ex)
{
	// Please be aware that you don't want to output the Exception message in
	// a production environment
	echo "Error with DB. Details: $ex";
	die();
}


header("Location: listAccess.php");
die();

?>
