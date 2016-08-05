<?php 
include("../includes/database_connection.php");
include("../includes/session.php");
include("../includes/functions.php");
?>
<?php ?>
<?php
if(isset($_POST['submit']))
{
	$password=$_POST['password'];
	$confirm_password=$_POST['confirm_password'];
	if($password==$confirm_password)
	{
		$confirm_change_password=change_password($_SESSION['name'],$_SESSION['email'],$password);
		if($confirm_change_password)
			redirect_to("login.php");
		else
			die("Password could not be changed");
	}
	else
	{
		destroy_Session();
		echo "Passwords do not match";
	}
}


?>

<!doctype html> 
<html lang="en" class="no-js"> 
<head> 
	<meta charset="UTF-8" /> 
	<title>Forgot Password</title>
</head>
<link rel="stylesheet" type="text/css" href="css/one.css" />
<link rel="stylesheet" type="text/css" href="css1/demo1.css" />
<link rel="stylesheet" type="text/css" href="css1/style.css" />
<body>
	<div id="forgot-password">
		<div class="forgot-password">
			
			<h2 id="brand-heading">favor.me</h2>
			<section class="content">
				<form action="confirm_recovery.php" method='POST'>
					<span class="input input--kaede">
						<input class="input__field input__field--kaede" type="text" name="password" style="color: #4d4dff" required autocomplete="off" />
						<label class="input__label input__label--kaede" for="input-37">
							<span class="input__label-content input__label-content--kaede" style="color:#000066;">Create Password</span>
						</label>
					</span>
					<span class="input input--kaede">
						<input class="input__field input__field--kaede" type="text" name="confirm_password" style="color: #4d4dff" required autocomplete="off" />
						<label class="input__label input__label--kaede" for="input-37">
							<span class="input__label-content input__label-content--kaede" style="color:#000066;">Confirm Password</span>
						</label>
					</span>
					<button type="submit" name="submit" class="btn-submit">RESET</button><br>
				</form>
				<div class="Login">
					<br />
					<a href="login.php"><h3>Log In <i class="fa fa-question-circle"></i></h3></a>
				</div>
			</section>
			<footer>
				<div class="bottom">
					<ul class="footer-info">
						<li><a href="about_us.php">About Us</a></li>
					</ul>
				</div>
			</footer>
		</div>
	</div>