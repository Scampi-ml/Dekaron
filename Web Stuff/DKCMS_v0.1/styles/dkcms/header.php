<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="en" />
<title><?php echo $sitetitle.$pb; ?></title>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link href="<?php echo $styledir ?>/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="container">
	<div class='logostrip'>
		<a href="?dkcms=main">
		</a>
	</div>
	<br />
	<div id="innerbody">
		<div id="leftMenu">
			<?php include("$styledir/leftmenu.php"); ?>
		</div>
		<div id="contentArea">	
			<div id="navBar">
				<div class="leftNav"><a href="?dkcms=main">Home</a></div>
			<?php
				if(isset($_SESSION['admin'])){
					echo "
				<div class='rightNav'><a href='?dkcms=admin'>Admin</a></div>";
				}
				if(isset($_SESSION['gm'])){
					echo "
				<div class='rightNav'><a href='?dkcms=gmcp'>GM</a></div>";
				}
				if(isset($_SESSION['id'])){
					echo "
				<div class='rightNav'><a href='?dkcms=ucp'>cPanel</a></div>";
				}
				else{
					echo "
				<div class='rightNav'><a href='?dkcms=main&amp;page=register'>Register</a></div>";
				}
				
			?>
				<div class='rightNav'><a href="?dkcms=main&amp;page=download">Downloads</a></div>
				<div class='rightNav'><a href="?dkcms=main&amp;page=ranking">Ranking</a></div>
				<div class='rightNav'><a href="?dkcms=main&amp;page=events">Events</a></div>
				<div class='rightNav'><a href="?dkcms=main&amp;page=news">News</a></div>
				<div class='rightNav'><a href='<?php echo $forumurl ?>'>Forum</a></div>
			</div>
		<br />