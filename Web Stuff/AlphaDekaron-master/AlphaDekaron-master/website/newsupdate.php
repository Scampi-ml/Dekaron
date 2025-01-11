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
		mssql_query("UPDATE osds.dbo.site_news SET content = '".mssql_escape(htmlentities($_POST['content'], ENT_QUOTES), 1)."',title = '".mssql_escape(htmlentities($_POST['title'], ENT_QUOTES))."' WHERE sid = '".mssql_escape($_POST['sid'])."'");
		echo '<strong>Edit done!</strong>';
	}
	if ($_GET['type'] == "delete")
	{	
		mssql_query("DELETE FROM osds.dbo.site_news WHERE sid = '".mssql_escape($_GET['sid'])."'");
		echo '<strong>Delete done!</strong>';
	}
	if ($_GET['type'] == "create")
	{
		$time = date("m/d/Y");
		mssql_query("INSERT INTO osds.dbo.site_news (title,wroteby,wrotedate,content) VALUES ('".mssql_escape(htmlentities($_POST['title'], ENT_QUOTES))."','".mssql_escape($_SESSION['news'])."','".mssql_escape($time)."','".mssql_escape(htmlentities($_POST['content'], ENT_QUOTES),1)."')");
		echo '<strong>News updated!</strong>';
	}
	echo '<table><tr><td class=header colspan=5>News Management</td></tr><tr><td><a href=?do=newsupdate&part=new>Add News</a></td></tr><tr><td><b><u>Title:</u></b></td><td><b><u>Written By:</u></b></td><td><b><u>Date:</u></b></td></tr>';
	$query = mssql_query("SELECT * FROM osds.dbo.site_news ORDER BY sid DESC");
	while($r = mssql_fetch_array($query))
	{
		echo '<tr><td><a href="?do=newsupdate&part=edit&sid=',$r['sid'],'">'.html_entity_decode(htmlentities($r['title'])).'</a></td><td>'.htmlentities($r['wroteby']).'</td><td>'.$r['wrotedate'].'</td><td><a href="?do=newsupdate&type=delete&sid='.$r['sid'].'">Delete</a></td></tr>';
	}
	echo '</table>';
} 
elseif ($_GET['part'] == "new")
{
	echo '<table><form method=post action=?do=newsupdate&type=create><tr><td class=header>News Management</td></tr>
	<tr><td>Title:<br><input type=text name=title /></td></tr>
	<tr><td>Message:<br><textarea cols=75 rows=25 name=content></textarea></td></tr>
	<tr><td><input type=submit value=Create /></td></tr></form></table>';
} 
elseif ($_GET['part'] == "edit")
{
	$query = mssql_query("SELECT * FROM osds.dbo.site_news WHERE sid = '".mssql_escape($_GET['sid'])."'");
	while($r = mssql_fetch_array($query))
	{
		echo '<table><tr><td class=header>News Management</td></tr>
		<form method=post action=?do=newsupdate&type=edit>
		<tr><td><input type=hidden name=sid value="',htmlentities($r['sid']),'" />Title:<br><input type=text name=title value="',html_entity_decode($r['title']),'" /></td></tr>
		<tr><td>Message:<br><textarea cols=75 rows=25 name=content>', html_entity_decode($r['content']),'</textarea></td></tr>
		<tr><td><input type=submit value=Edit /></td></tr></form></table>';
	}
}
?>