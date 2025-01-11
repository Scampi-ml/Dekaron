<?php
if(ALLOW_OPEN != '1') 
{
	Header('HTTP/1.1 403');
	exit(0);
}
else
{
	
	if ($_SESSION['isGM'] != '2')
	{
		Header('HTTP/1.1 403');
		exit(0);
	}
}

echo '<table><tr><td class=header colspan=3>Download Update</td></tr>';
if ($_GET['do1'] == "add")
{
	$link = str_replace("http://","",$_POST['link']);
	$link = str_replace("www.","",$link);
	$name = $_POST['name'];
	$version = $_POST['version'];
	mssql_query("INSERT INTO osds.dbo.site_download (link, name, version, descr) VALUES ('".mssql_escape($link)."','".mssql_escape($name)."','".mssql_escape($version)."','".mssql_escape($_POST['descr'])."')");
	echo '<tr><td>The download is added.</td></tr>';
}

if ($_GET['do1'] == "remove"){
	mssql_query("DELETE FROM osds.dbo.site_download WHERE sid = '".mssql_escape($_GET['sid'])."'");
	echo '<tr><td>The download is deleted.</td></tr>';
}

if ($_GET['do1'] == "edit")
{
	$link = str_replace("http://","",$_POST['link']);
	$link = str_replace("www.","",$link);
	mssql_query("UPDATE osds.dbo.site_download SET name = '".mssql_escape($_POST['name'])."',version = '".mssql_escape($_POST['version'])."',link = '".mssql_escape($link)."',descr = '".mssql_escape($_POST['descr'])."' WHERE sid = '".mssql_escape($_GET['sid'])."'");
	echo '<tr><td>The download has been edited.</td></tr>';
}

if ($_GET['part'] == "")
{
	echo '<tr><td><a href=?do=downloadupdate&part=new>New Download</a></td></tr>
	<tr><td>Name:</td><td>Version:</td></tr>';
	$query = mssql_query("SELECT * FROM osds.dbo.site_download ORDER BY sid DESC");
	while($r = mssql_fetch_array($query))
	{
		echo '<tr><td><a href="?do=downloadupdate&part=edit&sid='.$r['sid'].'">'.$r['name'].'</a></td>
		<td>'.$r['version'].'</td>
		<td><a href="?do=downloadupdate&id='.$id.'&do1=remove&sid='.$r['sid'].'">Remove</a></td></tr>';
	}
} 

elseif ($_GET['part'] == "edit")
{
	$query = mssql_query("SELECT * FROM osds.dbo.site_download WHERE sid = '".mssql_escape($_GET['sid'])."'");
	while($r = mssql_fetch_array($query))
	{
		echo '<form method=post action="?do=downloadupdate&do1=edit&sid='.$_GET['sid'].'">
		<tr><td>Name:<br><input type=text name=name value="'.$r['name'].'" /></td></tr>
		<tr><td>Version:<br><input type=text name=version value="'.$r['version'].'" /></td></tr>
		<tr><td>Link:<br><input type=text name=link value="http://'.$r['link'].'" /></td></tr>
		<tr><td><textarea cols=35 rows=8 name=descr>'.$r['descr'].'</textarea></td></tr>
		<tr><td><input type=submit value=Edit /></td></tr>
		</form>';
	}
}

elseif ($_GET['part'] == "new")
{
	echo '<form method=post action=?do=downloadupdate&do1=add>
	<tr><td>Name:<br><input type=text name=name /></td></tr>
	<tr><td>Version:<br><input type=text name=version /></td></tr>
	<tr><td>Link:<br><input type=text name=link /></td></tr>
	<tr><td>Description:<br><textarea cols=35 rows=8 name=descr></textarea></td></tr>
	<tr><td><input type=submit value=Add /></td></tr>
	</form>';
}

echo '
</table>';
?>