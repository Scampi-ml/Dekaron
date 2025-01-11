<?
$file = 'download';
if($is_gm != '0') {
echo '<table align="center" cellspacing="0" cellpadding="0">
<tr>
<td>';
if ($_GET['do'] == "add"){
$link = str_replace("http://","",$_POST['link']);
$link = str_replace("www.","",$link);
$name = $_POST['name'];
$version = $_POST['version'];
mssql_query("INSERT INTO site_download (link, name, version, descr) VALUES ('".$link."','".$name."','".$version."','".$_POST['descr']."')");
echo '<center><strong>The download is added.</strong></center>';
}

if ($_GET['do'] == "remove"){
mssql_query("DELETE FROM site_download WHERE id = '".$_GET['id']."'");
echo '<center><strong>The download is deleted.</strong></center>';
}
if ($_GET['do'] == "edit"){
$link = str_replace("http://","",$_POST['link']);
$link = str_replace("www.","",$link);
mssql_query("UPDATE site_download SET name = '".$_POST['name']."',version = '".$_POST['version']."',link = '".$link."',descr = '".$_POST['descr']."' WHERE id = '".$_GET['id']."'");
echo '<center><strong>The download has been edited.</strong></center>';
}
if ($_GET['part'] == ""){
echo '<table align="center" width="300">
<tr><td width="150"><strong>Name:</strong></td><td width="50"><strong>Version:</strong></td><td><a href="?function=download&uc='.$uc.'&amp;part=new"><strong>- New -</strong></a></td></tr>';
$query = mssql_query("SELECT * FROM site_download ORDER BY id DESC");
while($r = mssql_fetch_array($query)){
echo '<tr><td>'.$r['name'].'</td><td>'.$r['version'].'</td><td>
<a href="?function=download&uc='.$uc.'&amp;part=edit&amp;id='.$r['id'].'">Edit</a> - <a href="?function=download&uc='.$uc.'&amp;do=remove&amp;id='.$r['id'].'">Remove</a></td></tr>';
}
echo '</table><br />';
} else if ($_GET['part'] == "edit"){
$query = mssql_query("SELECT * FROM site_download WHERE id = '".$_GET['id']."'");
while($r = mssql_fetch_array($query)){
echo '<form method="post" action="?function=download&uc='.$uc.'&amp;do=edit&amp;id='.$_GET['id'].'"><table align="center" width="200">
<tr><td>Name:</td><td><input type="text" name="name" value="'.$r['name'].'" /></td></tr>
<tr><td>Version:</td><td><input type="text" name="version" value="'.$r['version'].'" /></td></tr>
<tr><td>Link:</td><td><input type="text" name="link" value="http://'.$r['link'].'" /></td></tr>
</table>
<center><textarea cols="35" rows="8" name="descr">'.$r['descr'].'</textarea><br />
<input type="submit" value="Edit" /></center>
</form>';
}
} else if ($_GET['part'] == "new"){
echo '<form method="post" action="?function=download&uc='.$uc.'&amp;do=add"><table align="center" width="200">
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
}
?>