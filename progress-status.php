<?php
	include_once 'db.php';

	session_start();
	if (!isset($_SESSION['UserId'])) {
		print("You are not logged in. Login here: ");
		print('<a href="index.php">Click here to login</a>');
		exit();
	}

	if (isset($_POST['Status-Submit'])) {
		if (!empty($_POST['Message'])) {
			$Username = $_SESSION['Username'];
			$Date = date("d-m-Y");
			$Message = $_POST['Message'];

			$sql = "INSERT INTO `Posts` (`Id`, `User`, `Message`, `Date`) VALUES ('', '$Username', '$Message', '$Date')";
			$result = mysqli_query($conn, $sql);
			if ($result == TRUE) {
				print("Posted!");
				print('<br><a href="dashboard.php">Click here to go back</a>');
				exit();
			} else {
				print("There was an error while trying to post your status. If you can't use speciel characters!");
				print('<br><a href="dashboard.php">Click here to go back</a>');
				exit();
			}
			
		} else {
			print("You need to type something in the status.");
			print('<br><a href="dashboard.php">Click here to go back</a>');
			exit();
		}
	} else {
		print("Try not to access this page via url.");
		print('<br><a href="dashboard.php">Click here to go back</a>');
		exit();
	}
	
?>