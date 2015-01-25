<?php 

	if (isset($_POST))
	{
		echo "<div>";

		echo "Age: " ;
		if (isset($_POST["age"]))
		 {
			echo $_POST["age"];
		}

		echo "<br>Video Games: ";
				if (isset($_POST["vidgames"]))
		 {
			echo $_POST["vidgames"];
		}

		echo "<br>Soda: ";
				if (isset($_POST["soda"]))
		 {
			echo $_POST["soda"];
		}
		echo "<br>Ender's Game: ";
		if (isset($_POST["book"]))
		 {
			echo $_POST["book"];
		}
		echo "</div>";
	}

	if file_exists("resultsFile.txt")
	{
		
	}
	else
	{
		$resultsFile = fopen("results.txt", "w") or die("Unable to open the file");
 	}
 ?>