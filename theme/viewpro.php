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
    <title>Admin Events</title>
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
                        <a href="#"><img src="images/vib_banner_small.png" style="width: 50%;height: 50%">w</a>
                    </h1>
                    </div>
                    <nav class="nav">
                        <ul class="sf-menu">                            
                            <li>
                                <a href="admin_land.php">Admin Home</a>                                
                            </li>
                            <li class="active">
                                <a href="event_admin.php">Participants</a>
                            </li>
                            <li>
                                <a href="onspote/index.php">On Spot Registration</a>
                            </li>
                            <li>
                                <?php echo "<a href='logout_admin.php'>Logout, ".$last_name[0]."</a>"; ?>
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
                    <h2><em>Proshows</em>Participants</h2>
                    <div class="row row__offset-2">
                        <center>
                            <div id="htmlexportPDF">                                
                                <?php
                                    
                                    $query = "SELECT * FROM proshow WHERE paid = 1";
                                    $result = mysqli_query($conn, $query);
                                    $entry = mysqli_num_rows($result);
                                    confirm_query($result); ?>    
                                        <p><h3>Vibrance'16</h3></p>
                                        <p><h3>Proshow Total Income</h3></p>                                        
                                        <p>
                                            <table id="exportPDF">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>College</th>
                                                    <th>Reg. No.</th>
                                                    <th>Ph. No.</th>
                                                    <th>Alternate No.</th>                                                    
                                                    <th>Type</th> 
                                                    <th>Price</th>                                           
                                                </tr><?php
                                            while ($list = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $list['name']; ?></td>
                                                    <td><?php echo $list['email']; ?></td>
                                                    <td><?php echo $list['college']; ?></td>
                                                    <td><?php echo $list['regno']; ?></td>
                                                    <td><?php echo $list['phno']; ?></td>
                                                    <td><?php echo $list['altphno']; ?></td>              
                                                    <td><?php echo $list['day']; ?></td>
                                                    <td class="count-me"><?php echo $list['price']; ?></td>
                                                </tr><?php                                             
                                            } ?>
                                            </table> 
                                        </p>   
                                    <?php                                    
                                ?> 
                                <p>
                                    <h3>Total income = Rs. <span id="total"></span> </h3>
                                    <h3>Total number of entries = <?php echo $entry; ?> </h3>
                                </p>                               
                            </div>   
                            <p><button onclick="javascript:htmltopdf();">Export PDF</button></p><hr>
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
    <script language="javascript" type="text/javascript">
    var tds = document.getElementById('exportPDF').getElementsByTagName('td');
    var sum = 0;
    for (var i = 0; i < tds.length; i++) {
        if (tds[i].className == 'count-me') {
            sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
        }
    }
    document.getElementById('total').innerHTML += sum;
    </script>
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