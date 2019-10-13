<?php
	include_once 'db.php';

	session_start();
	if (!isset($_SESSION['UserId'])) {
		print("You are not logged in. Login here: ");
		print('<a href="index.php">Click here to login</a>');
		exit();
	}

	session_destroy();
	print("You have now been logged out.");
	print('<br><a href="index.php">Click here to go back.</a>');
?>