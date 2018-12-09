<?php
	include_once 'db.php';

	session_start();
	if (!isset($_SESSION['UserId'])) {
		print("You are not logged in. Login here: ");
		print('<a href="index.php">Click here to login</a>');
		exit();
	}

	if (isset($_GET['Id'])) {
		//Checking if the id is correct
		$RequestId = $_GET['Id'];

		$sql = "SELECT * FROM `Friend-Requests` WHERE `Id`='$RequestId'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if ($count == 1) {
			while ($row = mysqli_fetch_array($result)) {
				$ToUser = $row['ToUser'];
				$FromUser = $row['FromUser'];
				$Date = $row['Date'];

				//Making the friendship
				$sql1 = "INSERT INTO `friends` (`Id`, `User1`, `User2`) VALUES ('', '$FromUser', '$ToUser')";
				$result1 = mysqli_query($conn, $sql1);
				$sql2 = "INSERT INTO `friends` (`Id`, `User1`, `User2`) VALUES ('', '$ToUser', '$FromUser')";
				$result2 = mysqli_query($conn, $sql2);
				if ($result1 && $result2 == TRUE) {
					//Deleting the request
					$sql = "DELETE FROM `Friend-Requests` WHERE `Id`='$RequestId'";
					$result = mysqli_query($conn, $sql);
					if ($result == TRUE) {
						print("You are now friends with " . $FromUser . ".");
						print('<br><a href="dashboard.php">Click here to go back</a>');
						exit();
					} else {
						print("There was an error while trying to delete the request.");
						print('<br><a href="dashboard.php">Click here to go back</a>');
						exit();
					}
					
				} else {
					print("There was an error while trying to make the friendship.");
					print('<br><a href="dashboard.php">Click here to go back</a>');
					exit();
				}
				
			}
		} else {
			print("There was an error while trying to find the id.");
			print('<br><a href="dashboard.php">Click here to go back</a>');
			exit();
		}
		
	} else {
		print("The system could not detect any id's. Try not to access this page with via url.");
		print('<br><a href="dashboard.php">Click here to go back</a>');
		exit();
	}

?>