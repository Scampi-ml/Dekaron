<?
$file = 'news';
if($is_gm != '0') {
	echo '<table align="center" cellspacing="0" cellpadding="0">
	<tr>
	<td><br />';
	if ($_GET['part'] == ""){
	if ($_GET['do'] == "edit"){
	mssql_query("UPDATE site_news SET content = '".$_POST['content']."',subject = '".$_POST['subject']."' WHERE id = '".$_POST['id']."'");
	echo '<center><strong>Edit done!</strong></center>';
	}
	if ($_GET['do'] == "delete"){
	mssql_query("DELETE FROM site_news WHERE id = '".$_GET['id']."'");
	echo '<center><strong>Delete done!</strong></center>';
	}
	if ($_GET['do'] == "create"){
	$time = date("d/m/Y");
	mssql_query("INSERT INTO site_news (subject, wroteby, wrotedate,content) VALUES ('".$_POST['subject']."','".$_SESSION['gm_name']."','".$time."','".$_POST['content']."')");
	echo '<center><strong>The news are created!</strong></center>';
	}
	
	echo '&nbsp;Only the 5 newest news will be showed.
	<table width="430" align="center">
	<tr><td width="150"><strong>Subject:</strong></td>
	<td width="100"><strong>Written By:</strong></td>
	<td width="100"><strong>Date:</strong></td>
	<td width="80"><a href="?function=news&uc='.$uc.'&amp;part=new"><strong>- New News -</strong></a></td></tr>';
	
	$query = mssql_query("SELECT * FROM site_news ORDER BY id DESC");
	while($r = mssql_fetch_array($query)){
	echo '<tr><td>'.$r['subject'].'</td><td>'.$r['wroteby'].'</td>
	<td>'.$r['wrotedate'].'</td>
	<td><a href="?function=news&uc='.$uc.'&amp;do=delete&amp;id='.$r['id'].'">Delete</a> - <a href="?function=news&uc='.$uc.'&amp;part=edit&amp;id='.$r['id'].'">Edit</a></td></tr>';
	}
	
	echo '</table>';
	} else if ($_GET['part'] == "new"){
	echo '<form method="post" action="?function=news&uc='.$uc.'&amp;do=create"><table width="430" align="center">
	<tr><td><center>You can use the following BBCodes:<br> <strong>[b][/b]</strong>, <strong>[i][/i]</strong>, <strong>[u][/u]</strong>, <strong>[center][/center]</strong> and <strong>[url=the-address]Name of like[/url]</strong>.<br>
	You can\'t use any html tags.<br /><br />Subject: <input type="text" name="subject" /><br />
	<textarea cols="75" rows="25" name="content" class="opera"></textarea><br />
	<input type="submit" value="Submit News" /></center></td></tr>
	</table></form>';
	} else if ($_GET['part'] == "edit"){
	$query = mssql_query("SELECT * FROM site_news WHERE id = '".$_GET['id']."'");
	while($r = mssql_fetch_array($query)){
	echo '<form method="post" action="?function=news&uc='.$uc.'&amp;do=edit"><table width="430" align="center">
	<tr><td><center>You can use the following BBCodes: <strong>[b][/b]</strong>, <strong>[i][/i]</strong>, <strong>[u][/u]</strong>, <strong>[center][/center]</strong> and <strong>[url=the-address]Name of like[/url]</strong>.
	You can\'t use any html tags.<br /><br /><input type="hidden" name="id" value="'.$r['id'].'" />Subject: <input type="text" name="subject" value="'.$r['subject'].'" /><br />
	<textarea cols="75" rows="25" name="content" class="opera">'.$r['content'].'</textarea><br />
	<input type="submit" value="Edit" /></center></td></tr>
	</table></form>';
	}
	}
	echo '</td>
	</tr>
	</table><br />';
}
?>