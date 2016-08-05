<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_admin_logged_in(); ?>
<?php 
$id = $_GET["id"];
$event = $_GET['event'];
$current_user = $_SESSION['username'];
date_default_timezone_set('Asia/Calcutta');
$confdate = date("Y/m/d");
$event_part = explode("_", $event);
$parti = $_GET['parti'];
if ($parti==1) {
	$type = "Individual";
} else {
	$type = "Team";
}
$price = $parti*$event_part[2];
$billno = "A".rand();
$name_query = "SELECT * FROM {$event} WHERE id = {$id} LIMIT 1";
$name_result = mysqli_query($conn, $name_query);
confirm_query($name_result);
$name_title = mysqli_fetch_assoc($name_result);
$email = $name_title['email'];

// registration bill html code starts

$content = "<!DOCTYPE html> ";
$content .= "<html> ";
$content .= "<head> ";
$content .= "<title>Bill</title> ";	
$content .= "</head> ";
$content .= "<body style='overflow: hidden;'> ";	
$content .= "<div style='background-color: #20202F; margin-right: 230px;'> ";
$content .= "<header> ";
$content .= "<img src='http://vitchennaivibrance.com/images/vib_banner_small.png' style='width: 180px;height: 60px;margin-right: 190px;'> ";
$content .= "<img src='http://vitchennaivibrance.com/images/vit_logo.png' style='width: 150px;height: 60px;'> ";
$content .= "</header> ";
$content .= "<h1 style='margin-left: 120px;	font-size: 40px; font-weight: 200px; margin-top: -0.5px; margin-bottom: -50px; color: #E85657;' >Vibrance 2016</h1><br> ";
$content .= "<h3 style='margin-bottom: 0;margin-top: 0;	margin-left: 10px; color: #E85657;'>Bill No: <span>".$billno."</span></h3><h3 style='margin-left: 160px;font-size: 18px;font-weight: 40px;margin-top: -2.5px;margin-bottom: 15px; color: #E85657;'>Electronic registration slip</h3> ";
$content .= "<br> ";
$content .= "<div style='font-size: 18px;margin-bottom: 12px;padding-bottom: 12px;margin-left: 12px;'> ";
$content .= "<div style='margin-top: -12px;display: block;margin-right: 10px;margin-left: 10px;margin-bottom: -1px;background-color: #2292A4;'> ";
$content .= "<form style='font-size: 18px;margin-bottom: 12px;padding-bottom: 12px;margin-left: 12px;'> ";
$content .= "<table style='border-collapse: collapse;margin-top: 2px;'> ";
$content .= "<tr style='margin-top: 12px;'> ";
$content .= "<td style='padding-top: 5px;padding-bottom: 5px; color: #ffffff;'> ";
$content .= "Event Name: ";
$content .= "</td> ";
$content .= "<td style='padding-right: 12px; color: #ffffff;'> ";
$content .= "<span>".ucfirst($event_part[0])."</span> ";
$content .= "</td> ";
$content .= "</tr> ";
$content .= "<tr style='margin-top: 12px;'> ";
$content .= "<td style='padding-top: 5px;padding-bottom: 5px; color: #ffffff;'>Name of the Participant: </td> ";
$content .= "<td style='padding-right: 12px; color: #ffffff;'> ".ucfirst($name_title['name'])."</td> ";
$content .= "</tr> ";
$content .= "<tr style='margin-top: 12px;'> ";
$content .= "<td style='padding-top: 5px;padding-bottom: 5px; color: #ffffff;'>Number of Participant(s): </td> ";
$content .= "<td style='padding-right: 12px; color: #ffffff;'> ".$parti."</td> ";
$content .= "</tr> ";
$content .= "<tr style='margin-top: 12px;'> ";
$content .= "<td style='padding-top: 5px;padding-bottom: 5px; color: #ffffff;'>Event Type: </td> ";
$content .= "<td style='padding-right: 12px; color: #ffffff;'> ".$type."</td> ";
$content .= "</tr> ";
$content .= "<tr style='margin-top: 12px;'> ";
$content .= "<td style='padding-top: 5px;padding-bottom: 5px; color: #ffffff;'>Event Registration Fee: </td> ";
$content .= "<td style='padding-right: 12px; color: #ffffff;'> ".$price."</td> ";
$content .= "</tr> ";
$content .= "</table> ";
$content .= "</div> ";
$content .= "</form> ";
$content .= "<div style='height: 10px;'></div> ";
$content .= "</div> ";
$content .= "</div> ";
$content .= "</body> ";
$content .= "</html>";

// registration bill html ends

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
$mail->Body    = $content;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
} 

$update_query = "UPDATE {$event} SET paid = 1, cnfby = '{$current_user}', confdate = '{$confdate}' WHERE id = {$id} LIMIT 1";
$update_result = mysqli_query($conn, $update_query);

//checking for updation
if ($result && mysqli_affected_rows($conn) == 1) {

	redirect_to("payments.php");
} else {

	redirect_to("payments.php");
}

?>
