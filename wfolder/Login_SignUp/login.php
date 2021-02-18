<?php
session_start ();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	//Something was posted
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];

	if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
	{

		//read from db
		$query = "select * from users where user_name = '$user_name' limit 1";
		$result = mysqli_query($con, $query);

		if($result)
		{
			if($result && mysqli_num_rows($result) > 0)
			{

				$user_data = mysqli_fetch_assoc($result);

				if($user_data['password'] === $password)
				{

					$_SESSION['user_id'] = $user_data['user_id'];
					header("Location: index.php");
					die;
				}
			}
		}

		echo "wrong username or password!";
	}else
	{
		echo "wrong username or password!";
	}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title> Login </title>
	<link rel="stylesheet" href="style.css">
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<body>
	<header>
    <h1>NLC CELL MANAGEMENT SYSTEM</h1></header>
		<div id="loginheader">
		    <h2>Login</h2>
		  </div>
		    <section class = "container">
<form method="POST">
	<div class="input-group">
		<label>Username</label>
	<input id="text" type="text" name="user_name">
</div>
	<div class="input-group">
		<label>Password</label>
		<input id="text" type="password" name="password">
	</div>
	<input class="button" id="button" type="submit" value="Login">
<p class="message">Not registered? <a href="signup.php">Create an account</a></p>
</form>
</div>

</body>
</html>
