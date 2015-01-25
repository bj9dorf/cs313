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
 
	if (file_exists("resultsFile.txt"))
	{
		echo "hello return user<br>";
		$text = file_get_contents("resultsFile.txt");
		echo $text;
	}
	else
	{
		$i = 0;
		foreach ($_POST as $item) 
		{
			$text[$i] = $item . "<br>";
			$i++;
		}
		file_put_contents("resultsFile.txt", $text);
 	}
 ?>