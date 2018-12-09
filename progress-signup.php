<?php
	include_once 'db.php';

	if (isset($_POST['Signup-Submit'])) {
		$Username = $_POST['Signup-Username'];
		$Password = $_POST['Signup-Password'];
		//Checking if the input is filled
		if (isset($Username, $Password)) {
			//Checking if the username is already taken
			$sql = "SELECT * FROM `Users` WHERE `Username`='$Username'";
			$result = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($result);
			//Checking if there is 0 rows when selected
			if ($count < 1) {
				//Creating the user
				$sql = "INSERT INTO `Users` (`Id`, `Username`, `Password`) VALUES ('', '$Username', '$Password')";
				$result = mysqli_query($conn, $sql);
				if ($result === TRUE) {
					print("You now have a user on News Feed!");
					print('<a href="index.php">Click here to login</a>');
					exit();
				} else {
					print("There was an error while tryuing to sign you up. Please try in a bit.");
					exit();
				}
				
			} else {
				print("There is already a user named that.");
				exit();
			}
			
		} else {
			print("You need to fill the form.");
			exit();
		}
		
	} else {
		print("You need to fill the form. Try not to access this page from url.");
		exit();
	}
	
?>