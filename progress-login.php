<?php
	include_once 'db.php';

	if (isset($_POST['Login-Submit'])) {
		$Username = $_POST['Login-Username'];
		$Password = $_POST['Login-Password'];
		//Checking if the input is filled
		if (isset($Username, $Password)) {
			//Checking if the users information is correct
			$sql = "SELECT * FROM `Users` WHERE `Username`='$Username' AND `Password`='$Password'";
			$result = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($result);
			if ($count == 1) {
				while ($row = mysqli_fetch_array($result)) {
					session_start();
					$_SESSION['UserId'] = $row['Id'];
					$_SESSION['Username'] = $row['Username'];
					print("You are now logged in.");
					header("Location: dashboard.php");
					die();
				}
			} else {
				print("Wrong Information.");
				exit();
			}
			
			
		}
	} else {
		print("You need to fill the form. Try not to access this page from url.");
		exit();
	}
	

?>