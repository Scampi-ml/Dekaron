<?php
session_start();
ob_start();
include 'class_report_error.php';
report_error::initialize();
report_error::report_error_Open(); 

include ('class_dekaron.php');

$dekaron = new dekaron_class();
include ('settings.php');

if(stristr($_SERVER['PHP_SELF'], 'header.php'))
{
	die("<strong>Error: </strong>Can't be opened directly!");
}

if(empty($_SESSION['USER']))
{
	echo "<script type='text/javascript'>window.location='index.php'; </script>";
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Dekaron Userpanel</title>

<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />
<link rel="stylesheet" media="screen" href="css/tables.css" />

<!--[if lt IE 8]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<![endif]-->

<!-- jquerytools -->
<script type="text/javascript" src="js/jquery.tools.min.js"></script>
<script type="text/javascript" src="js/jquery.tables.js"></script>
<script type="text/javascript" src="js/global.js"></script>

<!--[if lt IE 9]>
ie is shit
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/pie.js"></script>
<script type="text/javascript" src="js/ie9.js"></script>
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->

<script type="text/javascript"> jQuery(window).load(function() { jQuery('#loading-image').hide();});</script>

</head>
<?php
if (file_exists('maintenace.cache'))
{
?>
<body class="login">
    <div class="login-box main-content">
      <header><h2>System Message</h2></header>
    	<section>
    		<?php echo ' <div class="message error">We are performing maintenance at this moment.</div>'; ?>
    	</section>
    </div>
</body>
</html>
<?php
die();
}

?>

<body>
    <div id="wrapper">
             <header>
            <div class="container_8 clearfix">
                <h1 class="grid_1">
                <a href="overview.php">CP</a></h1>
                <nav class="grid_5">
                    <ul class="clearfix">
                        <li class="action"></li>
                        <li><a href="#">Website</a></li>
                        <li><a href="#">Forums</a></li>
                        <li><a href="#">Stats</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </nav>
                <span class="fr" style="padding-right: 10px; padding-top:10px;">Welcome, <?php echo $_SESSION['USER']; ?></span>
            </div>
        </header>
        <section>
            <div class="container_8 clearfix">