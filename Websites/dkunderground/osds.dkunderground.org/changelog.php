<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
	<title>OSDS V5 | Dekaron Control Panel</title>
	<meta http-equiv="Content-Language" content="en-us" />
	
	<meta http-equiv="imagetoolbar" content="no" />
	<meta name="MSSmartTagsPreventParsing" content="true" />
	
	<meta name="description" content="" />
    
	<meta name="keywords" content="" />
    <link href="./style.css" media="all" rel="stylesheet" type="text/css" />
    
    <script src="./js/jquery-1.2.6.pack.js" type="text/javascript"></script>
           
    <!--[if lt IE 7]>
       <script type="text/javascript" src="./js/supersleight-min.js"></script>
       <script type="text/javascript" src="./js/jquery.dropdown.js"></script>
       <style type="text/css" media="screen">
       @import url("http://theme.idowebdesign.ca/immaculee/blue/ie6.css");
           
    	</style>
        
	<![endif]--> 
    
    <script type="text/javascript">
    
	$(function() {
		$("body").addClass("has-script");
       
    });
	
    </script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>

    	<div id="container">
                    
            <!-- header -->
            <div id="header">
            
                <h1><a href="index.php"></a></h1>
          	</div>
            
            <?php include ('menu.php'); ?>
            
            <div id="subbar" class="clearfix">
            	
            <h1>Changelog <span>- Let's see what is changed</span></h1>
            

                    
        	</div><!-- end mainbar -->
           
   	    	        
            <div id="content" class="page clearfix">
            	
                <div id="main">
<?php

$db = array('dbname','dbuname','dbpass','dbserver');
/* BEGIN CHANGE */
/* dbname is the name of your database, dbuname is the username for you database
	dbpass is the password for your database, and dbserver is your mysql server (usually localhost) */
$db['dbname']	= 'c0d3r3d10';
$db['dbuname']	= 'c0d3r3d10';
$db['dbpass']	= '7rutRUpH';
$db['dbserver']	= 'remote-mysql4.servage.net';



$limit			= false;	// Change this to true if you wish to limit the number of updates shown
$theLimit		= '';		// Change this to the number of updates shown if you limit them

// NOT IMPLIMENTED YET: // <a href="changelog.php?op=postupdate">Post an update</a><br>
/*$passwordUpdate	= false;	// Change this to true if you wish to have to enter a password to post
$passwordTUpdate= '';		// Change this to the password you wish to use if you wish to use a password

$passwordVUpdt	= false;	// Change this if you wish to password protect viewing of the changelog
$passwordTVUpdt = '';		// Change this to the password for viewing the changelog if you wish to password it*/
/* END CHANGE */

mysql_connect($db['dbserver'],$db['dbuname'],$db['dbpass']);
mysql_select_db($db['dbname']);

if (!isset($_GET['op']))
	updates();
elseif ($_GET['op'] == 'postupdate')
	postUpdate();
elseif ($_GET['op'] == 'update')
	update();


function updates()
{
	global $limit,$theLimit;

	if ($limit)
	{
		$updateLimit = 'LIMIT '.$theLimit;
	}
	else
	{
		$updateLimit = '';
	}


	$getUpdates = mysql_query('SELECT * FROM updates ORDER BY date DESC '.$updateLimit);
	while ($update = mysql_fetch_assoc($getUpdates))
	{
		$date			= date('F d, Y',$update['date']);
		$version		= $update['version'];

		$tempNotes		= explode(';',$update['updateNotes']);
		$updateNotes	= '';
		for ($i=0; $i<count($tempNotes); $i++)
		{
			$updateNotes .= '<li>'.$tempNotes[$i].'</li>';
		}
		
		$updatedFiles	= '';
		$tempFiles		= explode(';',$update['updatedFiles']);
		for ($i=0; $i<count($tempFiles); $i++)
		{
			$tempFiles2		 = explode(',',$tempFiles[$i]);
			$updatedFiles	.= '<li><a href="changelog.php?op=filedetails&update='.$update['id'].'&file='.$tempFiles2[0].'">'.$tempFiles2[0].'</a></li>';
		}
		echo '
				<div style="width:100%; margin-bottom:30px;" class="post">
					<h2>'.$version.' - <small>'.$date.'</small> </h2>
					<p class="plus"><ul class="list">'.$updateNotes.'</ul></p>
				</div>';
	}
	mysql_free_result($getUpdates);
	unset($date,$version,$tempNotes,$updateNotes,$i,$tempFiles2,$tempFiles,$update);
}

function postUpdate()
{

	$request = mysql_query('SELECT version FROM updates ORDER BY id DESC LIMIT 1');
	$result = mysql_fetch_assoc($request);
	mysql_free_result($request);
	echo '
		<form name="update" action="changelog.php?op=update" method="POST">
		<table class="border" width="90%" cellspacing="1" cellpadding="0" border="0" align="center">
			<tr>
				<td>
					<table width="100%" cellspacing="0" cellpadding="3" border="0" align="center">

						<tr>
							<td class="bg">
								Version:
							</td>
							<td class="bg">
								<input type="text" name="version" size="40" value="'.$result['version'].'">
							</td>
						</tr>

						<tr>
							<td class="bg">
								Update notes:<br>
									Seperate comments via a ; like files.
									<br>
									Last one should have NO ;
							</td>
							<td class="bg">
								<textarea name="notes" rows="10" cols="40"></textarea>
							</td>
						</tr>
						<tr>
							<td class="bg" colspan="2" align="center">
								<input type="submit" name="submit" value="Post">
								<input type="hidden" name="files" value="">
								<input type="hidden" name="poster" value="Janvier123">
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>';

		unset($result);
}

function update()
{
	$date = time();
	mysql_query("INSERT INTO updates (version,updateNotes,updatedFiles,poster,date) VALUES ('$_POST[version]', '$_POST[notes]', '$_POST[files]', '$_POST[poster]', '$date')");

	header('Location: changelog.php');

	unset($date);
}




?>
                </div>
                <?php include ('side.php'); ?>
                
            </div>
        <!-- end content -->
            

            
          </div> <!--end container-->
   
</body>
</html>