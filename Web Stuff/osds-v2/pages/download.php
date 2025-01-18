<?php
	if (ALLOW_OPEN != 1){
	exit("<br><img src='images/error_access.png'>");
	}
include "../config/mssql.conf.php";
$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);

echo '<table align="center" cellspacing="0" cellpadding="0">
<td><a href="?do=download&id='.$id.'&part=new"><strong>- Create New Download -</strong></a></td>
<tr>
<td>';
if ($_GET['do1'] == "add"){
$link = str_replace("http://","",$_POST['link']);
$link = str_replace("www.","",$link);
$name = $_POST['name'];
$version = $_POST['version'];
mssql_query("INSERT INTO osds.dbo.site_download (link, name, version, descr) VALUES ('".$link."','".$name."','".$version."','".$_POST['descr']."')",$ms_con);
echo '<center><strong>The download is added.</strong></center>';
}

if ($_GET['do1'] == "remove"){
mssql_query("DELETE FROM osds.dbo.site_download WHERE sid = '".$_GET['sid']."'",$ms_con);
echo '<center><strong>The download is deleted.</strong></center>';
}
if ($_GET['do1'] == "edit"){
$link = str_replace("http://","",$_POST['link']);
$link = str_replace("www.","",$link);
mssql_query("UPDATE osds.dbo.site_download SET name = '".$_POST['name']."',version = '".$_POST['version']."',link = '".$link."',descr = '".$_POST['descr']."' WHERE sid = '".$_GET['sid']."'",$ms_con);
echo '<center><strong>The download has been edited.</strong></center>';
}
if ($_GET['part'] == ""){
echo '<table align="center" width="300">
<tr><td width="150"><strong>Name:</strong></td><td width="50"><strong>Version:</strong></td></tr>';
$query = mssql_query("SELECT * FROM osds.dbo.site_download ORDER BY sid DESC");
while($r = mssql_fetch_array($query)){
echo '<tr><td>'.$r['name'].'</td><td>'.$r['version'].'</td><td>
<a href="?do=download&id='.$id.'&part=edit&sid='.$r['sid'].'">Edit</a> - <a href="?do=download&id='.$id.'&do1=remove&sid='.$r['sid'].'">Remove</a></td></tr>';
}
echo '</table><br />';
} else if ($_GET['part'] == "edit"){
$query = mssql_query("SELECT * FROM osds.dbo.site_download WHERE sid = '".$_GET['sid']."'",$ms_con);
while($r = mssql_fetch_array($query)){
echo '<form method="post" action="?do=download&id='.$id.'&do1=edit&sid='.$_GET['sid'].'"><table align="center" width="200">
<tr><td>Name:</td><td><input type="text" name="name" value="'.$r['name'].'" /></td></tr>
<tr><td>Version:</td><td><input type="text" name="version" value="'.$r['version'].'" /></td></tr>
<tr><td>Link:</td><td><input type="text" name="link" value="http://'.$r['link'].'" /></td></tr>
</table>
<center><textarea cols="35" rows="8" name="descr">'.$r['descr'].'</textarea><br />
<input type="submit" value="Edit" /></center>
</form>';
}
} else if ($_GET['part'] == "new"){
echo '<form method="post" action="?do=download&id='.$id.'&do1=add"><table align="center" width="200">
<tr><td>Name:</td><td><input type="text" name="name" /></td></tr>
<tr><td>Version:</td><td><input type="text" name="version" /></td></tr>
<tr><td>Link:</td><td><input type="text" name="link" /></td></tr>
</table>
<center><textarea cols="35" rows="8" name="descr"></textarea><br />
<input type="submit" value="Add" /></center>
</form>';
}

echo '</td>
</tr>
</table><br />';
?>