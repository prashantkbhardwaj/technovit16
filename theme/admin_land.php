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

<!--<!DOCTYPE html>
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
-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>SOLID - Bootstrap 3 Theme</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="assets/js/modernizr.js"></script>
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">technoVIT'16</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
                <li class="active" <?php echo $view_whole; ?> >
                    <a href="admin_land.php">Admin Home</a>                               
                </li>
                <li <?php echo $view_whole; ?> >
                    <br>
                    <a href="<?php echo $link1; ?>"><?php echo $page; ?></a>
                </li>
                <li <?php echo $view_whole; ?> >
                    <a href="<?php echo $link2; ?>">On Spot Registration</a>
                </li>
                <li>
                    <?php echo "<a href='logout_admin.php'>Logout, ".$first_name[0]."</a>"; ?>
                </li>
            </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


    <!-- *****************************************************************************************************************
     TITLE & CONTENT
     ***************************************************************************************************************** -->

     <div class="container mtb">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 centered">
                <h2>Admin</h2>
                <br>
                <div class="hline"></div>
            </div>
        </div>
     </div><! --/container -->
     
    <!-- *****************************************************************************************************************
     About Us
     ***************************************************************************************************************** -->
    <div class="container mtb">
        <h2 style="text-align: center;"><em>Admin</em><?php echo $page; ?></h2>
        <div class="row__offset-2" >
            <div class="col-lg-6" >
                <a href="<?php echo $link1; ?>">
                    <img src="technologo.png">
                </a>
            </div>
            <div class="col-lg-6">
                <a href="<?php echo $link2; ?>"><br>
                    <img src="technologo.png" >
                </a>
            </div>
        </div>
        <div class="row__offset-2">
            <div class="col-lg-6">
                <a href="combo_date.php">><img src="technologo.png"></a>
            </div>
            <div class="col-lg-6">
                <a href="viewpro.php"><br><img src="technologo.png"></a>
            </div>
        </div>
     </div><! --/container -->
         

    <!-- *****************************************************************************************************************
     FOOTER
     ***************************************************************************************************************** -->
     <div id="footerwrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h4>Social Links</h4>
                    <div class="hline-w"></div>
                    <p>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-tumblr"></i></a>
                    </p>
                </div>
                <div class="col-lg-6">
                    <h4>Our Bunker</h4>
                    <div class="hline-w"></div>
                    <p>
                        Some Ave, 987,<br/>
                        23890, New York,<br/>
                        United States.<br/>
                    </p>
                </div>
            
            </div><! --/row -->
        </div><! --/container -->
     </div><! --/footerwrap -->
     
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/retina-1.1.0.js"></script>
    <script src="assets/js/jquery.hoverdir.js"></script>
    <script src="assets/js/jquery.hoverex.min.js"></script>
    <script src="assets/js/jquery.prettyPhoto.js"></script>
    <script src="assets/js/jquery.isotope.min.js"></script>
    <script src="assets/js/custom.js"></script>


    <script>
// Portfolio
(function($) {
    "use strict";
    var $container = $('.portfolio'),
        $items = $container.find('.portfolio-item'),
        portfolioLayout = 'fitRows';
        
        if( $container.hasClass('portfolio-centered') ) {
            portfolioLayout = 'masonry';
        }
                
        $container.isotope({
            filter: '*',
            animationEngine: 'best-available',
            layoutMode: portfolioLayout,
            animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        },
        masonry: {
        }
        }, refreshWaypoints());
        
        function refreshWaypoints() {
            setTimeout(function() {
            }, 1000);   
        }
                
        $('nav.portfolio-filter ul a').on('click', function() {
                var selector = $(this).attr('data-filter');
                $container.isotope({ filter: selector }, refreshWaypoints());
                $('nav.portfolio-filter ul a').removeClass('active');
                $(this).addClass('active');
                return false;
        });
        
        function getColumnNumber() { 
            var winWidth = $(window).width(), 
            columnNumber = 1;
        
            if (winWidth > 1200) {
                columnNumber = 5;
            } else if (winWidth > 950) {
                columnNumber = 4;
            } else if (winWidth > 600) {
                columnNumber = 3;
            } else if (winWidth > 400) {
                columnNumber = 2;
            } else if (winWidth > 250) {
                columnNumber = 1;
            }
                return columnNumber;
            }       
            
            function setColumns() {
                var winWidth = $(window).width(), 
                columnNumber = getColumnNumber(), 
                itemWidth = Math.floor(winWidth / columnNumber);
                
                $container.find('.portfolio-item').each(function() { 
                    $(this).css( { 
                    width : itemWidth + 'px' 
                });
            });
        }
        
        function setPortfolio() { 
            setColumns();
            $container.isotope('reLayout');
        }
            
        $container.imagesLoaded(function () { 
            setPortfolio();
        });
        
        $(window).on('resize', function () { 
        setPortfolio();          
    });
})(jQuery);
</script>
  </body>
</html>

<?php
    if (isset ($conn)){
      mysqli_close($conn);
    }
?>