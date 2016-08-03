<?php
function redirect_to($new_location) {
	header("Location: " . $new_location);
	exit; 
}
function mysql_prep($string) {
	global $conn;
	$escaped_string = mysqli_real_escape_string($conn, $string);
	return $escaped_string;
}
function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed.");
	}
}
function form_errors ($errors=array()) {
	$output = "";
	if (!empty($errors)) {
		$output .= "<div class=\"error\">";
		$output .= "Please fix the following errors:";
		$output .= "<ul>";
		foreach ($errors as $key => $error) {
			$output .= "<li>";
			$output .= htmlentities($error);
			$output .= "</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
	}
	return $output;
}
function find_all_users() {
	global $conn;

	$query = "SELECT * ";
	$query .= "FROM users ";
	$query .= "ORDER BY username ASC";
	$user_set = mysqli_query($conn, $query);
	confirm_query($user_set);
	return $user_set;
}
function find_user_by_id($user_id) {
	global $conn;

	$safe_user_id = mysqli_real_escape_string($conn, $user_id);

	$query = "SELECT * ";
	$query .= "FROM users ";
	$query .= "WHERE id = {$safe_user_id} ";
	$query .= "LIMIT 1";
	$user_set = mysqli_query($conn, $query);
	confirm_query($user_set);
	if ($user = mysqli_fetch_assoc($user_set)) {
		return $user;
	} else {
		return null;
	}
}
function find_all_admins() {
	global $conn;

	$query = "SELECT * ";
	$query .= "FROM admins ";
	$query .= "ORDER BY username ASC";
	$admin_set = mysqli_query($conn, $query);
	confirm_query($admin_set);
	return $admin_set;
}
function find_admin_by_id($admin_id) {
	global $conn;

	$safe_admin_id = mysqli_real_escape_string($conn, $admin_id);

	$query = "SELECT * ";
	$query .= "FROM admins ";
	$query .= "WHERE id = {$safe_admin_id}";
	$query .= "LIMIT 1";
	$admin_set = mysqli_query($conn, $query);
	confirm_query($admin_set);
	if ($admin = mysqli_fetch_assoc($admin_set)) {
		return $admin;
	} else {
		return null;
	}
}
function password_encrypt($password) {
	$hash_format = "$2y$10$";
	$salt_length = 22;
	$salt = generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($password, $format_and_salt);
	return $hash; 
}
function generate_salt($length) {
	$unique_random_string = md5(uniqid(mt_rand(), true));
	$base64_string = base64_encode($unique_random_string);
	$modified_base64_string = str_replace('+', '.', $base64_string);
	$salt = substr($modified_base64_string, 0, $length);
	return $salt;
}
function password_check($password, $existing_hash) {
$hash = crypt($password, $existing_hash);
if ($hash === $existing_hash) {
	return true;
} else {
	return false;
}
}
function find_user_by_username($username) {
	global $conn;
	$safe_username = mysqli_real_escape_string($conn, $username);

	$query = "SELECT * ";
	$query .= "FROM users ";
	$query .= "WHERE username = '{$safe_username}' ";
	$query .= "LIMIT 1";
	$user_set = mysqli_query($conn, $query);
	confirm_query($user_set);
	if ($user = mysqli_fetch_assoc($user_set)) {
		return $user;
	} else {
		return null;
	}
}
function find_admin_by_username($username) {
	global $conn;
	$safe_username = mysqli_real_escape_string($conn, $username);

	$query = "SELECT * ";
	$query .= "FROM admins ";
	$query .= "WHERE username = '{$safe_username}' ";
	$query .= "LIMIT 1";
	$admin_set = mysqli_query($conn, $query);
	confirm_query($admin_set);
	if ($admin = mysqli_fetch_assoc($admin_set)) {
		return $admin;
	} else {
		return null;
	}
}
function attempt_login($username, $password) {
	$user = find_user_by_username($username);
	if ($user) {
		if (password_check($password, $user["hashed_password"])) {
			return $user;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
function attempt_admin_login($username, $password) {
	$admin = find_admin_by_username($username);
	if ($admin) {
		if (password_check($password, $admin["hashed_password"])) {
			return $admin;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
function logged_in() {
	return isset($_SESSION['user_id']);
}
function admin_logged_in() {
	return isset($_SESSION['admin_id']);
}
function confirm_logged_in() {
	if (!logged_in()) {
		redirect_to("../index.html");
	}
}
function confirm_admin_logged_in() {
	if (!admin_logged_in()) {
		redirect_to("admin/index.php");
	}
}
//sending recovery code via mail
function send_recovery_mail($email,$generated_random_number)
{
    	require 'PHPMailer-master/PHPMailerAutoload.php';
 
		$mail = new PHPMailer;
		 
		$mail->isSMTP();                                      
		$mail->Host = 'smtp.gmail.com';                       
		$mail->SMTPAuth = true;                               
		$mail->Username = 'vibrancechennai@gmail.com';                   
		$mail->Password = 'NayaWala';               
		$mail->SMTPSecure = 'tls';                            
		$mail->Port = 587;                                    
		$mail->setFrom('vibrancechennai@gmail.com', 'Vibrance Registrations Team');
		$mail->addAddress("$email");       
		$mail->WordWrap = 50; 
		$mail->isHTML(true);                                  
		 
		$mail->Subject = 'Vibrance event registration.';
		$mail->Body    = 'You have successfully registered for <b>'.ucfirst($event_part[0]).'</b> in Vibrance16. Your E registration slip will be mailed and your participation will only be confirmed when you pay <b>Rs.'.$generated_random_number.'</b> at our payment desks in VIT.'.'<br>'.' Regards, Team Vibrance. ';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	

		if(!$mail->send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   exit;
}
?>