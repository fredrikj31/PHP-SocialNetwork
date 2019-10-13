<?php
	include_once 'db.php';

	session_start();
	if (!isset($_SESSION['UserId'])) {
		print("You are not logged in. Login here: ");
		print('<a href="index.php">Click here to login</a>');
		exit();
	}

	if (isset($_POST['AddFriend-Submit'])) {
		//Checking if the form is filled
		if (isset($_POST['SearchUsername'])) {
			$SearchedUser = $_POST['SearchUsername'];
			//Checking if a user is named that
			$sql = "SELECT * FROM `Users` WHERE `Username`='$SearchedUser'";
			$result = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($result);
			if ($count == 1) {
				$Username = $_SESSION['Username'];
				//Checking if the users is already friends
				$sql = "SELECT * FROM `Friends` WHERE `User1`='$Username' AND `User2`='$SearchedUser' OR `User1`='$SearchedUser' AND `User2`='$Username'";
				$result = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($result);
				if ($count == 0) {
					//Checking if the user has already sent a friend request to the user
					$sql = "SELECT * FROM `Friend-Requests` WHERE `ToUser`='$SearchedUser' AND `FromUser`='$Username' OR `ToUser`='$Username' AND `FromUser`='$SearchedUser'";
					$result = mysqli_query($conn, $sql);
					$count = mysqli_num_rows($result);
					if ($count == 0) {
						//Making the invite
						$Date = date("d-m-Y");

						$sql = "INSERT INTO `Friend-Requests` (`Id`, `ToUser`, `FromUser`, `Date`) VALUES ('', '$SearchedUser', '$Username', '$Date')";
						$result = mysqli_query($conn, $sql);
						if ($result == TRUE) {
							print("You have now sent a invite to " . $SearchedUser);
							print('<br><a href="dashboard.php">Click here to go back</a>');
							exit();
						} else {
							print("There was an error while trying to sign you up.");
							print('<br><a href="dashboard.php">Click here to go back</a>');
							exit();
						}
						
					} else {
						print("You have already sent that user an invite, or the user has sent you one. Try check you friend requests on the dashboard");
						print('<br><a href="dashboard.php">Click here to go back</a>');
						exit();
					}
					
				} else {
					print("You are already friends with that user.");
					print('<br><a href="dashboard.php">Click here to go back</a>');
					exit();
				}
			} else {
				print("There is not a user named that.");
				print('<br><a href="dashboard.php">Click here to go back</a>');
				exit();
			}
			
			
		} else {
			print("You need to fill the form.");
			print('<br><a href="dashboard.php">Click here to go back</a>');
			exit();
		}
		
	} else {
		print("You need to fill the form. Try not to access this page from url.");
		print('<br><a href="dashboard.php">Click here to go back</a>');
		exit();
	}
	
?>