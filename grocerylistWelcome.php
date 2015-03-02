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
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<div class="active"><h1>Welcome</h1></div>
				</div>
			</div>
			<div class="navbar-header"><h3 class="active">Please Login</h3></div>

		</nav>
	<?php 
	session_start();

//the class' working solution
	$badLogin = false;

	// First check to see if we have post variables, if not, just
	// continue on as always.

	if (isset($_POST['txtUser']) && isset($_POST['txtPassword']))
	{
		// they have submitted a username and password for us to check
		$username = $_POST['txtUser'];
		$password = $_POST['txtPassword'];

		// Get the hashed password from the DB
		// It would be better to store these in a different file
		try
		{
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

			$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);


			// this line makes PDO give us an exception when there are problems, and can be very helpful in debugging!
			$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

			$query = 'SELECT password FROM user WHERE username=:username';

			$statement = $db->prepare($query);
			$statement->bindParam(':username', $username);

			$result = $statement->execute();

			if ($result)
			{
				$row = $statement->fetch();
				$hashedPasswordFromDB = $row['password'];

				// now check to see if the hashed password matches
				if (password_verify($password, $hashedPasswordFromDB))
				{
					// password was correct, put the user on the session, and redirect to home
					$_SESSION['username'] = $username;
					header("Location: listAccess.php");
					die(); // we always include a die after redirects.
				}
				else
				{
					$badLogin = true;
				}

			}
			else
			{
				$badLogin = true;
			}
		}
		catch (Exception $ex)
		{
			// Please be aware that you don't want to output the Exception message in
			// a production environment
			//		echo "Error with DB. Details: $ex";
			die();
		}

	}
	if ($badLogin)
	{
		echo "<div>Incorrect username or password!</div>";
	}
// class solution ends here
	echo '<form class="form-horizontal" action="groceryListWelcome.php" method="post">
			<div class="form-group">
				<label for="username" class="col-sm-2 control-label">Username:</label>
				<div class="col-sm-10">
					<input class="form-control" type="text" placeholder="Username" name="txtUser">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-2 control-label">Password: </label>
				<div class="col-sm-10">
					<input class="form-control" type="password" placeholder="Password" name="txtPassword">
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-default">
				</div>
			</div>
		</form>';

		echo '</div> <br>';
		echo '<a href="signup.php">Create a new user</a>';

	?>
</body>
</html>