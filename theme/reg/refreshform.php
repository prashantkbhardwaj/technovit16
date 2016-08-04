<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>

<?php
	$current_user = $_SESSION["username"];
	$name_query = "SELECT * FROM users WHERE username = '{$current_user}' LIMIT 1";
	$name_result = mysqli_query($conn, $name_query);
	confirm_query($name_result);
	$name_title = mysqli_fetch_assoc($name_result);

	$name = $name_title['name'];
	$email = $current_user;
	$college = $name_title['college'];
	$regno = $name_title['regno'];
	$phno = $name_title['phno'];
	$altphno = $name_title['altphno'];
	$event = mysqli_real_escape_string($conn, htmlspecialchars($_POST['event1']));   
	$event_part = explode("_", $event);
	$parti = mysqli_real_escape_string($conn, htmlspecialchars($_POST['parti1']));   
	if (($name_title['college']!="VIT")&&($event_part[3]=="d")) {
		$price = $parti*100;
	} else {
		$price = $parti*$event_part[2];
	}
	if ($event=="socialinnovators_team_150_s") {
		if ($parti==1) {
			$price = 150;
		} elseif ($parti==2) {
			$price = 250;
		} elseif ($parti==3) {
			$price = 300;
		}
	}
	$combo = "NO";
	date_default_timezone_set('Asia/Calcutta');
    $confdate = date("Y/m/d");
	$check_query = "SELECT * FROM {$event} WHERE email = '{$current_user}' ";
	$check_result = mysqli_query($conn, $check_query);
	confirm_query($check_result);
	$check = mysqli_fetch_assoc($check_result);

	if ($check['email']== $email) {
		echo "You have already registered for this event. ";
	}

	else 
	{
		
		echo "hello";
		$query = "INSERT INTO {$event} (name, email, college, regno, phno, altphno, parti, combo, price)";
		$query .= " VALUES ('{$name}', '{$email}', '{$college}', '{$regno}', '{$phno}', '{$altphno}', {$parti}, '{$combo}', {$price})";
		$result = mysqli_query($conn,$query);	

	    if ($result) {
	    	echo "$query";
	      	echo"You have succesfully registered for Vibrance16. Please check your email for the details. Your registraion will only be confirmed after you make the payment at our registration desk in VIT.";		
	    } 
	    else 
	    {
	    	echo "$query";
		   	echo "hello loser";
		   	echo"Registration failed.";
	    }    
	}		
?>      	
  
<?php
	if (isset ($conn)){
	  mysqli_close($conn);
	}
?>

