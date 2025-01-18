<?php
	// Load the core
	include "osdsv4core.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $Config->get( 'site_title', 'GENERAL'); ?></title>
        <meta charset="utf-8">
        
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/superfish.css">
        <link rel="stylesheet" type="text/css" href="css/uniform.default.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.wysiwyg.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.asmselect.css">
        <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css">
        <link rel="stylesheet" type="text/css" href="css/skins/blue.css" title="blue">

        <link rel="alternate stylesheet" type="text/css" href="css/skins/orange.css" title="orange">
        <link rel="alternate stylesheet" type="text/css" href="css/skins/red.css" title="red">
        <link rel="alternate stylesheet" type="text/css" href="css/skins/green.css" title="green">
        <link rel="alternate stylesheet" type="text/css" href="css/skins/purple.css" title="purple">
        <link rel="alternate stylesheet" type="text/css" href="css/skins/yellow.css" title="yellow">
        <link rel="alternate stylesheet" type="text/css" href="css/skins/black.css" title="black">
        <link rel="alternate stylesheet" type="text/css" href="css/skins/gray.css" title="gray">

        
        <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.11.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
        <script type="text/javascript" src="js/superfish.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
        <script type="text/javascript" src="js/jquery.cookie.js"></script>
		<script type="text/javascript" src="js/switcher.js"></script>
        <script type="text/javascript" src="js/jquery.asmselect.js"></script>
    </head>
<body>
<header id="top">
	<div class="container_12 clearfix">
		<div id="logo" class="grid_5">
			<a id="site-title" href="index.php"><span><?php echo $Config->get( 'site_name', 'GENERAL'); ?></span></a>
             	<?php
				$show_site_url = $Config->get( 'show_site_url', 'GENERAL');
				if($show_site_url == 'true')
				{
					echo '<a id="view-site" href="' . $Config->get( 'site_url', 'GENERAL') . '">Your site</a>';
				}
            	?>
            
		</div>
        <div class="grid_4" id="colorstyle">
			<div>Change Color</div>
			<a href="#" rel="blue"></a>
			<a href="#" rel="green"></a>
			<a href="#" rel="red"></a>
			<a href="#" rel="purple"></a>
			<a href="#" rel="orange"></a>
			<a href="#" rel="yellow"></a>
			<a href="#" rel="black"></a>
			<a href="#" rel="gray"></a>
		</div>
        <?php
		$show_username = $Config->get( 'show_username', 'GENERAL');
		if($show_username == 'true')
		{
				echo '<div id="userinfo" class="grid_3">';
				echo 'Welcome, <a href="edit_account.php?account=' . $_SESSION['user_no'] . '">' . $_SESSION['user_id'] . '</a>';
				echo '</div>';
		}
		?>
	</div>
</header>
<nav id="topmenu">
	<div class="container_12 clearfix">
		<div class="grid_12">
			<ul id="mainmenu" class="sf-menu">
				<li class="current"><a href="index.php">Dashboard</a></li>
				<li><a href="#">Account Tool</a>
                	<ul>
						<li><a href="online_accounts.php">Online Accounts</a></li>
						<li><a href="edit_account.php?account=<?php echo $_SESSION['user_no']; ?>">My account</a></li>
					</ul>
				</li>
				<li><a href="#">Character Tool</a>
                	<ul>
                        <li><a href="view_guilds.php">View Guilds</a></li>
                        <li><a href="send_item_basic.php">Send Item (Basic)</a></li>
                        <li><a href="send_item_advanced.php">Send Item (Wizard)</a></li>
                        
					</ul>
				</li>
                <li><a href="#">Log Tool</a>
                	<ul>
                        <li><a href="view_log.php">View Logs</a></li>
					</ul>
				</li>
                <li><a href="#">Database Tool</a>
                    <ul>
                    	<li><a href="edit_deadfront.php">Manage Deadfront</a></li>
                    	<li><a href="view_database_info.php">View Database Info</a></li>
					</ul>
				</li>
                <li><a href="settings.php">Settings</a></li>
			
                <li><a href="#">Extra</a>
                    <ul>
                        <li><a href="http://www.dkunderground.org/forums/"> OSDS Forums </a></li>
                        <li><a href="http://www.dkunderground.org/forums/topic/243-read-this-how-to-report-errors-bugs/"> Report a bug + Support </a></li>
                        <li><a href="emblem/index.php"> Emblem Generator  </a></li>
                    </ul>
                </li>
			</ul>
			<ul id="usermenu">
            <?php
				$inbox_system = $Config->get( 'inbox_settings', 'GENERAL');
				if($inbox_system == 'true')
				{
					echo '<li><a href="inbox.php" class="inbox">Inbox</a></li>';
				}
			?>
				<li>
                    <!-- Added in R2 confirm box on logout -->
                    <a href="#" onClick="logout()">Logout</a>
                    <script language="JavaScript">
                        function logout(){
                            var answer=confirm("Are you sure you want to logout?")
                            if(answer)
                            window.location="logout.php"
                        }
                    </script>
                </li>
			</ul>
		</div>
	</div>
</nav>
<section id="content">
	<section class="container_12 clearfix">
		<section id="main" class="grid_9 push_3">
        <?php echo printMessages(); ?>