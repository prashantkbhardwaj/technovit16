
<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php
if (admin_logged_in()) {
    redirect_to ("../admin_land.php");
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
        $found_admin = attempt_admin_login($username, $password);

        if ($found_admin) {

            $_SESSION["admin_id"] = $found_admin["id"];
            $_SESSION["username"] = $found_admin["username"];
            redirect_to("../admin_land.php");
        } else {
            $_SESSION["message"] = "Username/password not found.";
        }
    }
} else {

}
?>
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="normalize.css">
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
    /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
    
    @import url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
    @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);
    body {
        margin: 0px;
        padding: 0px;
        background: #fff;
        color: #fff;
        font-family: Arial;
        font-size: 12px;
        overflow: none;
    }
    
    .body {
        position: absolute;
        top: 0px;
        left: 0px;
        right: 0px;
        bottom: 0px;
        width: auto;
        height: auto;
        background-image: url(../images/1.jpg);
        background-size: cover;
        -webkit-filter: blur(5px);
        z-index: 0;
    }
    
    .grad {
        position: absolute;
        top: -20px;
        left: -20px;
        right: -40px;
        bottom: -40px;
        width: auto;
        height: auto;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.65)));
        /* Chrome,Safari4+ */
        z-index: 1;
        opacity: 0.7;
    }
    
    .header {
        position: absolute;
        top: calc(50% - 35px);
        left: calc(50% - 255px);
        z-index: 2;
    }
    
    .header div {
        float: left;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 35px;
        font-weight: 200;
    }
    
    .header div span {
        color: #5379fa !important;
    }
    
    .login {
        position: absolute;
        top: calc(50% - 75px);
        left: calc(50% - 50px);
        height: 150px;
        width: 350px;
        padding: 10px;
        z-index: 2;
    }
    
    .login input[type=text] {
        width: 250px;
        height: 30px;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
    }
    
    .login input[type=password] {
        width: 250px;
        height: 30px;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
        margin-top: 10px;
    }
    
    .login input[type=submit] {
        width: 260px;
        height: 35px;
        background: #fff;
        border: 1px solid #fff;
        cursor: pointer;
        border-radius: 2px;
        color: #a18d6c;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 6px;
        margin-top: 10px;
    }
    
    .login input[type=submit]:hover {
        opacity: 0.8;
    }
    
    .login input[type=submit]:active {
        opacity: 0.6;
    }
    
    .login input[type=text]:focus {
        outline: none;
        border: 1px solid rgba(255, 255, 255, 0.9);
    }
    
    .login input[type=password]:focus {
        outline: none;
        border: 1px solid rgba(255, 255, 255, 0.9);
    }
    
    .login input[type=submit]:focus {
        outline: none;
    }
    
    ::-webkit-input-placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
    
    ::-moz-input-placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
    </style>
    <script src="js/prefixfree.min.js"></script>
</head>

<body>
    <div class="body"></div>
    <div class="grad"></div>
    <div class="header">
        <div>Admin<span>Login</span></div>
    </div>
    <br>
    <div class="login">
        <form method="post" action="index.php">
            <input type="text" placeholder="username" name="username" required>
            <br>
            <input type="password" placeholder="password" name="password" required>
            <br>
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
<script type="text/javascript">
    // lock scroll position, but retain settings for later
      var scrollPosition = [
        self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
        self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
      ];
      var html = jQuery('html'); // it would make more sense to apply this to body, but IE7 won't have that
      html.data('scroll-position', scrollPosition);
      html.data('previous-overflow', html.css('overflow'));
      html.css('overflow', 'hidden');
      window.scrollTo(scrollPosition[0], scrollPosition[1]);

</script>
</html>
<?php
if (isset ($conn)){
  mysqli_close($conn);
}
?>