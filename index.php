<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>News Feed | Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="main.css" />
	<script src="main.js"></script>
</head>
<body>
	<center>

		<h1>Welcome to News Feed</h1>
		<p>Please login or signup if you dont have an account.</p>

		<br>
		<br>

		<h3>Login:</h3>
		<form action="progress-login.php" method="POST">
			Username: <input type="text" name="Login-Username" placeholder="Username..."><br>
			Password: <input type="password" name="Login-Password" placeholder="Password..."><br><br>
			<input type="submit" name="Login-Submit" value="Login">
		</form>

		<br>
		<br>
		<br>
		<br>
		<br>

		<h3>Signup:</h3>
		<form action="progress-signup.php" method="POST">
			Username: <input type="text" name="Signup-Username" placeholder="Username..."><br>
			Password: <input type="text" name="Signup-Password" placeholder="Password..."><br><br>
			<input type="submit" name="Signup-Submit" value="Signup">
		</form>

	</center>
</body>
</html>