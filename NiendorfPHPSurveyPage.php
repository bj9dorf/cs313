<?php
session_start();
?>

<?php
	if ($_SESSION["visited"] != "true")
	{
		echo "
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form action=\"NiendorfPHPSurvey.php\" method=\"post\">
		<p>How old are you?</p>
		<div>
			<label for=\"age\">18-20</label>
			<input type=\"radio\"  name=\"age\" value=\"18-20\"> <br/>
			<label for=\"age\">21-22</label>
			<input type=\"radio\"  name=\"age\" value=\"21-22\"> <br/>
			<label for=\"age\">23-24</label>
			<input type=\"radio\" a name=\"age\" value=\"23-24\"> <br/>
			<label for=\"age\">25-26</label>
			<input type=\"radio\"  name=\"age\" value=\"25-26\"> <br/>
			<label for=\"age\">27+</label>
			<input type=\"radio\"  name=\"age\" value=\"27+\"> <br/>
		</div>
		<br/>

		<p>On a scale of 1-10, how much do you enjoy video games?</p>
		<div>
			<label for=\"vidgames\">1</label>
			<input type=\"radio\" name=\"vidgames\" value=\"1\"> <br/>
			<label for=\"vidgames\">2</label>
			<input type=\"radio\" name=\"vidgames\" value=\"2\"> <br/>
			<label for=\"vidgames\">3</label>
			<input type=\"radio\" name=\"vidgames\" value=\"3\"> <br/>
			<label for=\"vidgames\">4</label>
			<input type=\"radio\" name=\"vidgames\" value=\"4\"> <br/>
			<label for=\"vidgames\">5</label>
			<input type=\"radio\" name=\"vidgames\" value=\"5\"> <br/>
			<label for=\"vidgames\">6</label>
			<input type=\"radio\" name=\"vidgames\" value=\"6\"> <br/>
			<label for=\"vidgames\">7</label>
			<input type=\"radio\" name=\"vidgames\" value=\"7\"> <br/>
			<label for=\"vidgames\">8</label>
			<input type=\"radio\" name=\"vidgames\" value=\"8\"> <br/>
			<label for=\"vidgames\">9</label>
			<input type=\"radio\" name=\"vidgames\" value=\"9\"> <br/>
			<label for=\"vidgames\">10</label>
			<input type=\"radio\" name=\"vidgames\" value=\"10\"> <br/>
		</div>
		<br/>

		<p>Which do you prefer, Pepsi or Coca-Cola?</p>
		<div>
			<label for=\"soda\">Pepsi</label>
			<input type=\"radio\"  name=\"soda\" value=\"Pepsi\"> 
			<br/>
			<label for=\"soda\">Coca-Cola</label>
			<input type=\"radio\"  name=\"soda\" value=\"Coke\"> 
			<br/>
			<label for=\"soda\">Neither</label>
			<input type=\"radio\"  name=\"soda\" value=\"Neither\"> 
			<br/>
			<label for=\"soda\">Both equally</label>
			<input type=\"radio\"  name=\"soda\" value=\"Both\"> 
			<br/>
		</div>
		<br/>

		<p>Have you read the Ender\'s Game series?</p>
		<div>
			<label for=\"book\">Yes</label>
			<input type=\"radio\"  name=\"book\" value=\"Yes\"> <br/>
			<label for=\"book\">No</label>
			<input type=\"radio\"  name=\"book\" value=\"No\"> <br/>
			<label for=\"book\">Parts</label>
			<input type=\"radio\" a name=\"book\" value=\"Parts\"><br/>
		</div>
		<br/>
		<input type=\"submit\"> <br><br>
		<a href=\"http://localhost/cs313testing/NiendorfPHPSurvey.php\">Don't vote and go straight to results</a>
	</form>
</body>
</html>";
}
else
{
	echo "Survey has been taken!";
}
$_SESSION["visited"] = "false";//"true";
