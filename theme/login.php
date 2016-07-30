<?php require_once("/includes/session.php");?>
<?php require_once("/includes/db_connection.php");?>
<?php require_once("/includes/functions.php");?>
<?php require_once("/includes/validation_functions.php"); ?>
<?php
if (logged_in()) {
	redirect_to ("../index.html");
}
?>
<?php
$username = ""; 
if (isset($_POST['submit'])) { 

	$required_fields = array("username", "password");
	validate_presence($required_fields);

	if (empty($errors)) {

		$username = $_POST['username'];
		$password = $_POST['password'];
		$found_user = attempt_login($username, $password);

		if ($found_user) {

			$_SESSION["user_id"] = $found_user["id"];
			$_SESSION["username"] = $found_user["username"];
			redirect_to("../index.html");
		} else {
			$_SESSION["message"] = "Hub ID/password not found.";
		}
	}
} else {

}
?>
<?php
if(isset($_POST['signup'])){

	$required_fields = array("username", "password");
	validate_presence($required_fields);

	$fields_with_max_lengths = array("username" => 60);
	validate_max_lengths($fields_with_max_lengths);

	if (empty($errors)) {

		$name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name']));   
		$username = mysql_prep($_POST['username']);  
		if (empty($_POST['college'])) {
			$college = "VIT";
		} else {
			$college = mysqli_real_escape_string($conn, htmlspecialchars($_POST['college']));
		}
		if (isset($_POST['regno'])) {
			$regno = mysqli_real_escape_string($conn, htmlspecialchars($_POST['regno']));
		} else {
			$regno = "";
		}
		$phno = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phno']));
		$altphno = mysqli_real_escape_string($conn, htmlspecialchars($_POST['altphno']));
		$hashed_password = password_encrypt($_POST['password']);         

		$query = "INSERT INTO users (name, username, college, regno, phno, altphno, hashed_password)";
		$query .= " VALUES ('{$name}', '{$username}', '{$college}', '{$regno}', '{$phno}', '{$altphno}', '{$hashed_password}')";
		$result = mysqli_query($conn, $query);

		if ($result) {
			$_SESSION["message"] = "Your account created!";         
		} else {
			$_SESSION["message"] = "Profile account failed.";
		}         
	}
} 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | Tag</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
</head>
<style type="text/css">
	form{
		margin-top: 1em;
	}
	nav{
		background-color: #384452;
	}
	.page-head-title{
		margin-top: 1em;
		text-align: center;
	}

</style>
<body>
	<header>
		<nav>
			<div class="nav-wrapper">
				<a href="#" class="brand-logo">TechnoVIT 16</a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="#" onclick="Login()">Login</a></li>
					<li><a href="#" onclick="Signup()">Sign Up</a></li>
					<li><a href="aboutus.html">About Us</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<main>
		<div class="container" id="login">
			<h3 class="page-head-title">Login</h3>
			<form class="col s6 offset-s6" action="login.php" method="POST">
				<div class="row">
					<div class="input-field col s6 offset-s3">
						<label for="Username">Username:</label>
						<input type="text" name="username">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6 offset-s3">
						<label for="password">Password:</label>
						<input type="password" name="password">
					</div>
				</div>
				<div align="center">
					<input type="submit" class="waves-effect waves-light btn" name="submit" value="Login">
				</div>
			</form>
		</div>
		<div class="container" id="signup" style="display:none;">
			<h3 style="text-align:center;">Signup</h3>
			<form class="col s6 offset-s6" action="login.php" method="POST">
				<div class="row">
					<div class="input-field col s6 offset-s3">
						<label for="name">
							Name:
						</label>
						<input style="margin-bottom:10px;" type="text" name="name">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6 offset-s3">
						<label for="Username">Username:</label>
						<input style="margin-bottom:10px;" type="text" name="username">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6 offset-s3">
						<label for="email">E-mail:</label>
						<input style="margin-bottom:10px;" type="email" name="email">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6 offset-s3">
						<label for="regno">Registration Number :</label>
						<input style="margin-bottom:10px;" type="text" name="regno">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6 offset-s3">
						<label for="college">Name of college:</label>
						<input style="margin-bottom:10px;" type="text" name="college">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6 offset-s3">
						<label for="password">Password:</label>
						<input style="margin-bottom:10px;" type="password" name="password">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6 offset-s3">
						<label for="phno">Phone Number:</label>
						<input style="margin-bottom:10px;" type="text" name="phno">
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6 offset-s3">
						<label for="altphno">Alternate Phone Number:</label>
						<input style="margin-bottom:10px;" type="text" name="altphno">
					</div>
				</div>
				<div align="center">
					<input type="submit" class="waves-effect waves-light btn" name="signup" value="Signup">
				</div>
			</form>
		</div>
	</main>
</body>
<script type="text/javascript">
	function Login(){
		$('#signup').slideUp();
		$('#login').slideDown();		
	}
	function Signup(){
		$('#signup').slideDown();
		$('#login').slideUp();	
	}
</script>
</html>