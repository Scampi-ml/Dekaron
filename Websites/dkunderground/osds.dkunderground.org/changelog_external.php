<?php

header("Expires: 0"); 

$db = array('dbname','dbuname','dbpass','dbserver');
/* BEGIN CHANGE */
/* dbname is the name of your database, dbuname is the username for you database
	dbpass is the password for your database, and dbserver is your mysql server (usually localhost) */
$db['dbname']	= 'c0d3r3d10';
$db['dbuname']	= 'c0d3r3d10';
$db['dbpass']	= '7rutRUpH';
$db['dbserver']	= 'remote-mysql4.servage.net';



$limit			= false;	// Change this to true if you wish to limit the number of updates shown
$theLimit		= 99999;		// Change this to the number of updates shown if you limit them

// NOT IMPLIMENTED YET: // <a href="changelog.php?op=postupdate">Post an update</a><br>
/*$passwordUpdate	= false;	// Change this to true if you wish to have to enter a password to post
$passwordTUpdate= '';		// Change this to the password you wish to use if you wish to use a password

$passwordVUpdt	= false;	// Change this if you wish to password protect viewing of the changelog
$passwordTVUpdt = '';		// Change this to the password for viewing the changelog if you wish to password it*/
/* END CHANGE */

mysql_connect($db['dbserver'],$db['dbuname'],$db['dbpass']);
mysql_select_db($db['dbname']);




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
			$updateNotes .= '-| '.$tempNotes[$i].'<br>';
		}
		
		$updatedFiles	= '';
		$tempFiles		= explode(';',$update['updatedFiles']);
		for ($i=0; $i<count($tempFiles); $i++)
		{
			$tempFiles2		 = explode(',',$tempFiles[$i]);
			$updatedFiles	.= '<li><a href="changelog.php?op=filedetails&update='.$update['id'].'&file='.$tempFiles2[0].'">'.$tempFiles2[0].'</a></li>';
		}
		echo '<p>-------------------------------------------<br>'.$version.' - '.$date.'<br> '.$updateNotes.'-------------------------------------------</p>';
	}
	mysql_free_result($getUpdates);
	unset($date,$version,$tempNotes,$updateNotes,$i,$tempFiles2,$tempFiles,$update);




	


?>
