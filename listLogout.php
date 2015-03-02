<?php

require("password.php"); // used for password hashing.
session_start();
unset($_SESSION['username']);
unset($_SESSION['mainuser']);
unset($_SESSION['userId']);

header("Location: groceryListWelcome.php");
die(); // we always include a die after redirects.