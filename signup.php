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
				<div class="active"><h3>Please create your username and password</h3></div>
			</div>
		</div>
	</nav>
	<form  class="form-horizontal" action="createAccount.php" method="post">
		<div class="form-group">
			<label class="col-sm-2" for="username">Username: </label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="username"/><br>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2" for="passowrd">Password: </label>
			<div class="col-sm-10">	
				<input class="form-control" type="password" name="password"><br>
			</div>
		</div>
		<input type="submit" value="Create Account"> <br><br>
	</form>

	<div>
	<a href="http://localhost/cs313testing/grocerylistWelcome.php">Back to login page</a>
	</div>

</body>
</html>