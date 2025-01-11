<?php
if(ALLOW_OPEN != '1') 
{
	Header('HTTP/1.1 403');
	exit(0);
}
else
{
	
	if ($_SESSION['isGM'] == '0')
	{
		Header('HTTP/1.1 403');
		exit(0);
	}
}
if ($_GET['part'] == "")
{
	if ($_GET['type'] == "edit")
	{
		$sdate = date("n/j/o g:i A",strtotime($_POST['sdate']));
		$edate = date("n/j/o g:i A",strtotime($_POST['edate']));
		if($sdate <= $edate)
		{
			$date = date("n/j/o g:i A",strtotime($_POST['date']));
			mssql_query("UPDATE osds.dbo.event SET eDesc = '".mssql_escape(htmlentities($_POST['content'], ENT_QUOTES),1)."',eName = '".mssql_escape(htmlentities($_POST['title'], ENT_QUOTES))."', eStart = '".mssql_escape(htmlentities($sdate, ENT_QUOTES))."', eEnd = '".mssql_escape(htmlentities($edate, ENT_QUOTES))."' WHERE eid = '".mssql_escape($_POST['eid'])."'");
			echo '<strong>Edit done!</strong>';
		}
		else
		{
			echo '<strong>End date cannot be earlier than starting date!</strong>';
		}
	}
	if ($_GET['type'] == "delete")
	{	
		mssql_query("DELETE FROM osds.dbo.event WHERE eid = '".mssql_escape($_GET['eid'])."'");
		echo '<strong>Delete done!</strong>';
	}
	if ($_GET['type'] == "create")
	{
		$sdate = date("n/j/o g:i A",strtotime($_POST['sdate']));
		$edate = date("n/j/o g:i A",strtotime($_POST['edate']));
		if($sdate <= $edate)
		{
		mssql_query("INSERT INTO osds.dbo.event(eName,eHost,eStart,eEnd,eDesc) VALUES ('".mssql_escape(htmlentities($_POST['title'], ENT_QUOTES))."','".mssql_escape($_SESSION['news'])."','".mssql_escape($sdate)."','".mssql_escape($edate)."','".mssql_escape(htmlentities($_POST['content'], ENT_QUOTES),1)."')");
		echo '<strong>Event added!</strong>';
		}
		else
		{
			echo '<strong>End date cannot be earlier than starting date!</strong>';
		}
	}
	echo '<table><tr><td class=header colspan=5>Events Management</td></tr><tr><td><a href=?do=eupdate&part=new>Add Event</a></td></tr><tr><td><b><u>Event:</u></b></td><td><b><u>Host:</u></b></td><td><b><u>Start Date:</u></b><td><b><u>End Date:</u></b></td></tr>';
	$query = mssql_query("SELECT eID, eName, eHost, eStart, eEnd FROM osds.dbo.event ORDER BY eStart desc, eEnd desc");
	while($r = mssql_fetch_array($query))
	{
		echo '<tr><td><a href="?do=eupdate&part=edit&eid=',htmlentities($r['eID']),'">'.html_entity_decode(htmlentities($r['eName'])).'</a></td><td>'.htmlentities($r['eHost']).'</td><td>'.$r['eStart'].'</td><td>'.$r['eEnd'].'</td><td><a href="?do=eupdate&type=delete&eid='.$r['eID'].'">Delete</a></td></tr>';
	}
	echo '</table>';
} 
elseif ($_GET['part'] == "new")
{
	echo '<table><form method=post action=?do=eupdate&type=create><tr><td class=header>Events Management</td></tr>
	<tr><td>Name:<br><input type=text name=title /></td></tr>
	<tr><td>Start Date (MM/DD/YYYY HH:MM AM/PM):<br><input type=text name=sdate /></td></tr>
	<tr><td>End Date (MM/DD/YYYY HH:MM AM/PM):<br><input type=text name=edate /></td></tr>
	<tr><td>Description:<br><textarea cols=75 rows=25 name=content></textarea></td></tr>
	<tr><td><input type=submit value=Create /></td></tr></form></table>';
} 
elseif ($_GET['part'] == "edit")
{
	$query = mssql_query("SELECT * FROM osds.dbo.event WHERE eid = '".mssql_escape(html_entity_decode($_GET['eid']))."'");
	$isThere = mssql_num_rows($query);
	echo '<table>';
	if ($isThere == 1)
	{
	$r = mssql_fetch_array($query);
		echo '<tr><td class=header>Events Management</td></tr>
		<form method=post action=?do=eupdate&type=edit>
		<tr><td><input type=hidden name=eid value="',htmlentities($r['eID']),'" />Name:<br><input type=text name=title value="',html_entity_decode($r['eName']),'" /></td></tr>
		<tr><td>Start Date (MM/DD/YYYY HH:MM AM/PM)<br><input type=text name=sdate value="',html_entity_decode($r['eStart']),'" /></td></tr>
		<tr><td>End Date (MM/DD/YYYY HH:MM AM/PM)<br><input type=text name=edate value="',html_entity_decode($r['eEnd']),'" /></td></tr>
		<tr><td>Description:<br><textarea cols=75 rows=25 name=content>', html_entity_decode($r['eDesc']),'</textarea></td></tr>
		<tr><td><input type=submit value=Edit /></td></tr></form>';
	}
	else
	{
		echo '<tr><td>Cannot find event.</td></tr>';
	}
	echo '</table>';
}
?>