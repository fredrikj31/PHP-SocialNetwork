<?php
	include_once 'db.php';

	session_start();
	if (!isset($_SESSION['UserId'])) {
		print("You are not logged in. Login here: ");
		print('<a href="index.php">Click here to login</a>');
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>News Feed | Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="main.css" />
	<script src="main.js"></script>
</head>
<body>
	<center>
		<h1>Welcome to you dashboard <?php print($_SESSION['Username']); ?>!</h1>
		<br>
		<a href="logout.php">Click here to logout.</a>
		<br>
		<h3>Friend List:</h3>
		<?php
			$Username = $_SESSION['Username'];

			$sql = "SELECT * FROM `Friends` WHERE `User1`='$Username'";
			$result = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($result);
			if ($count > 0) {
				while ($row = mysqli_fetch_array($result)) {
					$FriendUsername = $row['User2'];
					
					print('<p>' . $FriendUsername . '</p>');
				}
			} else {
				print('<p>You have no friends right now.</p>');
			}
			
		?>
		<br>
		<br>
		<h3>Friend Requests:</h3>
		<?php
			$Username = $_SESSION['Username'];

			$sql = "SELECT * FROM `Friend-Requests` WHERE `ToUser`='$Username'";
			$result = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($result);
			if ($count > 0) {
				while ($row = mysqli_fetch_array($result)) {
					$RequestId = $row['Id'];
					$FromUser = $row['FromUser'];
					$RequestDate = $row['Date'];

					print($RequestDate . '<b> | </b>' . "Friend request from " . $FromUser . " " . " - " . '<a href="progress-acceptfriend.php?Id=' . $RequestId . '"> Accept</a>');
				}
			} else {
				print('<p>You have no friend requests.</p>');
			}
			
		?>
		<br>
		<br>
		<br>
		<h3>Add Friend:</h3>
		<form action="progress-friend.php" method="POST">
			Friend Name: <input type="text" name="SearchUsername" placeholder="Friend Username..." ><br><br>
			<input type="submit" name="AddFriend-Submit" value="Add Friend">
		</form>
		<br>
		<br>
		<br>
		<h3>Post Status:</h3>
		<form action="progress-status.php" method="POST" id="StatusForm">
			<textarea style="resize: none;" rows="4" cols="50" maxlength="500" name="Message" form="StatusForm" placeholder="What's on your heart?"></textarea><br>
			<input type="submit" name="Status-Submit" value="Post Status">
		</form>
		<br>
		<h3>News Feed:</h3>
		<?php
			$Username = $_SESSION['Username'];

			$sql = "SELECT * FROM `Posts` WHERE `User` IN(SELECT `User1` FROM `Friends` WHERE `User2` = '$Username') ORDER BY `Date` DESC";
			$result = mysqli_query($conn, $sql);
			$count = mysqli_num_rows($result);
			if ($count > 0) {
				while ($row = mysqli_fetch_array($result)) {
					$PostUser = $row['User'];
					$PostMessage = $row['Message'];
					$PostDate = $row['Date'];

					print('<p>' . $PostUser . ' - <i>' . $PostDate . '</i></p>');
					print('<p>' . $PostMessage . '</p>');
					print('<br>');
					print('<br>');
				}
			} else {
				print('<p>There is no posts from your friends</p>');
			}
			
		?>
	</center>
</body>
</html>