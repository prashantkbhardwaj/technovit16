<?php require_once("includes/session.php");?>
<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_admin_logged_in(); ?>
<?php
    $current_user = $_SESSION["username"];
    $name_query = "SELECT * FROM admins WHERE username = '{$current_user}' LIMIT 1";
    $name_result = mysqli_query($conn, $name_query);
    confirm_query($name_result);
    $name_title = mysqli_fetch_assoc($name_result);    
?>

<?php
    if ($name_title['type']=="event_admin") {
        $link1 = "event_admin.php";
        $link2 = "#";
        $linkup = "";
        $page = "Participants";
        $view_whole = "style='display: none;'";
        $img1 = "parti_list.jpg";
        $img2 = "onspot.jpg";
        $first_name = explode("_", $name_title['username']);
    } elseif ($name_title['type']=="payment_admin") {
        $link1 = "payments.php";
        $link2 = "onspot/index.php";
        $linkup = "";
        $page = "Payments";
        $view_whole = "style='display: none;'";
        $img1 = "payconf.jpg";
        $img2 = "onspot.jpg";
        $first_name = explode(" ", $name_title['username']);
    } elseif ($name_title['type']=="super_admin") {
        $link1 = "payments.php";
        $link2 = "onspot/index.php";
        $page = "Payments";
        $linkup = "<a href='admin_signup.php'>Make new Admin</a>";
        $view_whole = "style='display: none;'";
        $img1 = "payconf.jpg";
        $img2 = "onspot.jpg";
        $first_name = explode(" ", $name_title['username']);
    } elseif ($name_title['type']=="viewer_admin") {
        $link1 = "event_date.php";
        $link2 = "pro_date.php";
        $page = "Faculty";
        $linkup = "";
        $img1 = "date_report.jpg";
        $img2 = "date_proshow.jpg";
        $view_whole = "";
        $first_name = explode(" ", $name_title['username']);
    }
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Payments</title>
</head>

<body>
  <a href="event_admin.php"><?php echo "$link1"; ?></a>
  <a href=""><?php echo "$link1"; ?></a>
  <a href=""><?php echo "$link2"; ?></a>
  <a href=""><?php echo "$linkup"; ?></a>
  <a href="logout_admin.php"><?php echo "Logout";echo "$first_name[0]"; ?></a>
</body>

</html>
<?php
    if (isset ($conn)){
      mysqli_close($conn);
    }
?>