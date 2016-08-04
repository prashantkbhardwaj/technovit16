<?php require_once("includes/session.php"); ?>
<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php confirm_admin_logged_in(); ?>

<?php
    $current_user = $_SESSION["username"];
    $name_query = "SELECT * FROM admins WHERE username = '{$current_user}' LIMIT 1";
    $name_result = mysqli_query($conn, $name_query);
    confirm_query($name_result);
    $name_title = mysqli_fetch_assoc($name_result);    
?>

<?php
    if (($name_title['type']=="viewer_admin") | ($name_title['type']=="super_admin")) {
        $view_whole = "";         
    } else {
        $view_whole = "style='display: none;'";        
    }    
?>  

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Payments</title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no" />
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.2.1.js"></script>
    <script type='text/javascript' src='http://code.jquery.com/jquery-git2.js'></script>
    <script type='text/javascript' src="http://codeinnovators.meximas.com/pdfexport/jspdf.debug.js"></script>
    <!--[if lt IE 9]>
    <html class="lt-ie9">
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/..">
            <img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820"
                 alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
        </a> 
    </div>
    <script src="js/html5shiv.js"></script>
    <![endif]-->
    <script src='js/device.min.js'></script>
</head>

<body>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}
th {
    text-align: left;
}
</style>
    <div class="page">
        <!--========================================================
                              HEADER
    =========================================================-->
        <header>
            <div id="stuck_container" class="stuck_container">
                <div class="container">
                    <div class="brand">
                        <h1 class="brand_name">
                        <a href="./">Vibrance'16</a>
                    </h1>
                    </div>
                    <nav class="nav">
                        <ul class="sf-menu">
                            <li>
                                <a href="admin_land.php">Admin Home</a>                                
                            </li>                                                      
                            <li>
                                <?php echo "<a href='logout_admin.php'>Logout, ".$current_user."</a>"; ?>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <!--========================================================
                              CONTENT
    =========================================================-->
        <main <?php echo $view_whole; ?> >
            <section class="well well__offset-3">
                <div class="container">
                    <h2><em>Payments</em>Section</h2>
                    <div class="row row__offset-2">
                        <center>
                            <form action="combo_date.php" method="post">
                                <select name="date">
                                    <option value="">Select a date</option>
                                    <option value="2016/03/02">2nd March, 2016</option>
                                    <option value="2016/03/03">3rd March, 2016</option>
                                    <option value="2016/03/04">4th March, 2016</option>
                                    <option value="2016/03/08">8th March, 2016</option>
                                    <option value="2016/03/09">9th March, 2016</option>
                                    <option value="2016/03/10">10th March, 2016</option>
                                    <option value="2016/03/11">11th March, 2016</option>
                                    <option value="2016/03/12">12th March, 2016</option>
                                    <option value="2016/03/13">13th March, 2016</option>
                                    <option value="2016/03/14">14th March, 2016</option>
                                    <option value="2016/03/15">15th March, 2016</option>
                                    <option value="2016/03/16">16th March, 2016</option>
                                    <option value="2016/03/17">17th March, 2016</option>
                                    <option value="2016/03/18">18th March, 2016</option>
                                    <option value="2016/03/19">19th March, 2016</option>
                                </select>
                                <input type="submit" name="submit" value="Go">
                            </form>                            
                            <?php
                                if (isset($_POST['submit'])) {
                                    $confdate = $_POST['date'];                                    
                                    $combo_query = "SELECT SUM(price) AS total_combo_price FROM combo WHERE paid = 1 AND confdate = '{$confdate}'";
                                    $combo_result = mysqli_query($conn, $combo_query);
                                    $combo_list = mysqli_fetch_assoc($combo_result);?>
                                    <div id="htmlexportPDF">   
                                    <p><h3>Vibrance'16</h3></p>
                                    <p><h3>Combo Income date wise</h3></p>
                                    <p><h3>Date: <?php echo $confdate; ?></h3></p>                                 
                                    <p>
                                        <table id="exportPDF">
                                            <tr>                                                
                                                <th>Income</th>                                                
                                            </tr>
                                            <tr>
                                                <td><?php echo $combo_list['total_combo_price']; ?></td>
                                            </tr>                                    
                                        </table>    
                                    </p> <?php
                                }    
                            ?>
                            </div>
                            <p><button onclick="javascript:htmltopdf();">Export PDF</button></p>                            
                        </center>
                    </div>
                </div>
            </section>
        </main>
        <!--========================================================
                              FOOTER
    =========================================================-->
        <footer>
        </footer>
    </div>
    <script src="js/script.js"></script>  
    
    <script type='text/javascript'>
    function htmltopdf() {
        var pdf = new jsPDF('p', 'pt', 'letter');
        source = $('#htmlexportPDF')[0];
        specialElementHandlers = {
            '#bypassme': function(element, renderer) {
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        pdf.fromHTML(
            source,
            margins.left,
            margins.top, {
                'width': margins.width,
                'elementHandlers': specialElementHandlers
            },

            function(dispose) {
                pdf.save('Download.pdf');
            }, margins);
    }
    </script>
</body>

</html>
<?php
    if (isset ($conn)){
      mysqli_close($conn);
    }
?>