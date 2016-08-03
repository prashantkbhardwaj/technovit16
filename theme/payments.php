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
    if (($name_title['type']=="payment_admin") | ($name_title['type']=="super_admin")) {
        $view_whole = "";         
    } else {
        $view_whole = "style='display: none;'";        
    }
    if ($name_title['type']=="super_admin") {
        $view_cnf = "";
    } else {
        $view_cnf = "style='display: none;'";
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
                        <a href="#"><img src="images/vib_banner_small.png" style="width: 50%;height: 50%"></a>
                    </h1>
                    </div>
                    <nav class="nav">
                        <ul class="sf-menu">
                            <li>
                                <a href="admin_land.php">Admin Home</a>                                
                            </li>
                            <li class="active">
                                <a href="payments.php">Payments</a>
                            </li>
                            <li>
                                <a href="onspot/index.php">On Spot Registration</a>
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
                            <a href="combo_payment.php"><h3>Combo Payments</h3></a>
                            <form action="payments.php" method="post">
                                <select name="event">
                                    <option value="">Select an event</option>
                                    <option value="adaptune_alone_100_s">Adaptune</option>
                                    <option value="bollywoodbattle_team_100_s">Bollywood Battle</option>
                                    <option value="dancingduo_team_100_s">Dancing Duo</option>
                                    <option value="choreonight_team_3500_s">Choreo Night</option>
                                    <option value="footloose_alone_100_s">Footloose</option>
                                    <option value="dumbcharades_team_50_s">Dumb Charades</option>
                                    <option value="soundhunt_team_50_s">Sound Hunt</option>
                                    <option value="supersinger_alone_100_s">Super Singer</option>
                                    <option value="battleofbands_team_1000_s">Battle of bands</option>
                                    <option value="artiste_alone_100_s">Artiste</option>
                                    <option value="fifa15_alone_150_s">FIFA 15</option>
                                    <option value="dota2_team_500_s">Dota 2</option>
                                    <option value="counterstrike_team_500_s">Counter Strike</option>
                                    <option value="socialinnovators_team_150_s">Social Innovators</option>

                                    <option value="generalquiz_team_50_d">General Quiz</option>
                                    <option value="entertainmentquiz_team_50_d">Entertainment Quiz</option>
                                    <option value="karlpopperdebate_team_50_d">Karl Popper Debate</option>
                                    <option value="classicdebate_alone_50_d">Classic Debate</option>
                                    <option value="splitpersonality_alone_50_d">Split Personality</option>
                                    <option value="centrestage_alone_50_d">Centre Stage</option>
                                    <option value="aircrash_alone_50_d">Air Crash</option>
                                    <option value="lapersona_alone_50_d">La Persona</option>
                                    <option value="potpourri_team_50_d">Potpourri</option>
                                    <option value="litquiz_alone_50_d">Lit Quiz</option>
                                    <option value="turncourt_alone_50_d">Turn Court</option>
                                    <option value="scrabble_team_50_d">Dabble in Scrabble</option>
                                    <option value="adzap_team_50_d">Adzap</option>
                                    <option value="switch_team_50_d">Switch</option>
                                    <option value="daretodrama_team_50_d">Dare to Drama</option>
                                    <option value="beapicasso_alone_50_d">Be a Picasso</option>
                                    <option value="cupodoodle_alone_50_d">Cup O' Doodle</option>
                                    <option value="mehendi_team_50_d">Mehendi</option>
                                    <option value="paintwithoutbrush_team_50_d">Paint Without a Brush</option>
                                    <option value="gandhi_team_50_d">Gandhi: How far do you know him?</option>
                                    <option value="postermaking_alone_50_d">Poster Making</option>
                                    <option value="brain_team_50_d">Brain 0.0</option>
                                    <option value="virtualreality_alone_50_d">Virtual Reality</option>
                                    <option value="wastecraft_team_50_d">Wastecraft</option>
                                    <option value="enviroquiz_team_50_d">Enviro Quiz</option>
                                    <option value="balloonsplash_team_50_d">Balloon Splash</option>
                                    <option value="blindfolddrawing_alone_50_d">Blind Fold Drawing</option>
                                    <option value="dressupyourpartner_team_50_d">Dress Up Your Partner</option>
                                    <option value="irrelevance_alone_50_d">Irrelevance</option>
                                    <option value="minutetowin_team_50_d">VIT's Minute to Win it</option>
                                    <option value="runforbucks_team_50_d">Run for Bucks</option>
                                    <option value="impracticaljokers_alone_50_d">Impractical Jokers</option>
                                    <option value="moriarty_team_50_d">Moriarty</option>
                                    <option value="fivefootball_team_50_d">5's Football</option>
                                    <option value="buildtodestroy_team_50_d">Build to Destroy</option>
                                    <option value="tugofwar_team_50_d">Tug of War</option>
                                    <option value="vishwaroopam_team_50_d">Vishwaroopam</option>
                                    <option value="veta_team_50_d">Veta</option>
                                    <option value="chitram_team_50_d">Chitram</option>
                                    <option value="antaksharitelugu_team_50_d">Antakshari TELUGU</option>
                                    <option value="dhammu_team_50_d">Dhammu</option>
                                    <option value="rangam_team_50_d">Rangam</option>
                                    <option value="begborrowsteal_team_50_d">Beg, Borrow, Steal</option>
                                    <option value="comicstrip_alone_50_d">Comic Strip</option>
                                    <option value="creativewriting_alone_50_d">Creative Writing</option>
                                    <option value="poetry_alone_50_d">Poetry</option>
                                    <option value="jam_alone_50_d">JAM</option>
                                    <option value="expressionexpress_alone_50_d">Expression Express</option>
                                    <option value="antaksharihindi_team_50_d">Antakshari HINDI</option>
                                    <option value="televisionwarping_team_50_d">Television Warping</option>
                                    <option value="tambola_alone_50_d">Tambola</option>
                                    <option value="filmbuffchallenge_team_50_d">Film Buff Challenge</option>
                                    <option value="floattilluwin_team_50_d">Float till you Win</option>
                                    <option value="hellothamizha_team_50_d">Hello Thamizha</option>
                                    <option value="maathipesavum_alone_50_d">Maathi Pesavum</option>
                                    <option value="merasalaaitan_team_50_d">Merasalaaitan</option>
                                    <option value="therikkavidalama_team_50_d">Therikka Vidalama</option>
                                    <option value="nerdornewbie_team_50_d">Nerd or Newbie</option>
                                    <option value="treasurehunt_team_50_d">Treasure Hunt [App Based]</option>
                                    <option value="snakeandladder_alone_50_d">Snake and Ladder with Quiz</option>
                                    <option value="aimandact_team_50_d">Aim and Act</option>
                                    <option value="tamilworkshop_alone_50_d">Tamil Speaking Workshop</option>
                                </select>
                                <input type="submit" name="submit" value="Go">
                            </form>
                            <?php
                                if (isset($_POST['submit'])) {
                                    $event = $_POST['event'];
                                    $event_name = explode("_", $event);
                                    $query = "SELECT * FROM {$event} ";
                                    $result = mysqli_query($conn, $query);
                                    confirm_query($result); ?>
                                    <h3><?php echo $event_name[0]; ?></h3>
                                    <h4><?php echo $event_name[1]; ?></h4>
                                    <p>
                                        <table>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>College</th>
                                                <th>Reg. No.</th>
                                                <th>Ph. No.</th>
                                                <th>Status</th>
                                                <th>Participants</th>
                                                <th>Combo</th>
                                                <th>Fees</th>
                                                <th>Action</th>
                                                <th <?php echo $view_cnf; ?>>Confirmed By</th>
                                            </tr><?php
                                        while ($list = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $list['name']; ?></td>
                                                <td><?php echo $list['email']; ?></td>
                                                <td><?php echo $list['college']; ?></td>
                                                <td><?php echo $list['regno']; ?></td>
                                                <td><?php echo $list['phno']; ?></td>
                                                <td><?php echo $list['paid']; ?></td>
                                                <td><?php echo $list['parti']; ?></td>
                                                <td><?php echo $list['combo']; ?></td>
                                                <td><?php echo $list['price']; ?></td>
                                                <td>                                                   
                                                    <a href="payconfirm.php?id=<?php echo urlencode($list["id"]); ?>&event=<?php echo urlencode($event); ?>&parti=<?php echo urlencode($list['parti']); ?>" onclick="return confirm('Are you sure?');"><?php
                                                    if ($list['paid']==0) {
                                                        echo "<font color='red'>"."Pay"."</font>";
                                                    } else {
                                                        echo "<font color='green'>"."Paid"."</font>";
                                                    } ?>
                                                    </a>                                                    
                                                </td>
                                                <td <?php echo $view_cnf; ?>><?php echo $list['cnfby']; ?></td>
                                            </tr><?php                                             
                                        } ?>
                                        </table>    
                                    </p> <?php
                                }    
                            ?>                            
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
</body>

</html>
<?php
    if (isset ($conn)){
      mysqli_close($conn);
    }
?>