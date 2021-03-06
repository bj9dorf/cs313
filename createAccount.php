<?php

$username = $_POST['username'];
$password = $_POST['password'];

if (!isset($username) || $username == ""
	|| !isset($password) || $password == "")
{
	header("Location: signUp.php");
	die(); 
}

$username = htmlspecialchars($username);
// Get the hashed password.
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	$openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$dbName = "shoppingList";
	if ($openShiftVar === null || $openShiftVar == "")
	{
     echo "Not in the openshift environment";
	    $dbHost = "127.11.29.130";
		$dbUser = "bruce"; //trying to get openshift to work
		$dbPassword = "brucepass";
		
	}
	else 
	{
    	echo "In the openshift environment <br>";
	    $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
		$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
		$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	}

try
{
	// Create the PDO connection
	$db = new PDO ("mysql:host=127.11.29.130;dbname=shoppingList",	$dbUser, $dbPassword);

	// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$query = 'INSERT INTO user(username, password) VALUES(:username, :password)';

	$statement = $db->prepare($query);

	$statement->bindParam(':username', $username);
	$statement->bindParam(':password', $hashedPassword);

	$statement->execute();
}
catch (Exception $ex)
{
	// Please be aware that you don't want to output the Exception message in
	// a production environment
	echo "Error with DB. Details: $ex";
	die();
}


header("Location: grocerylistWelcome.php");
die();

?>
