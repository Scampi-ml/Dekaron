<?php
if (ALLOW_OPEN != 1){
	exit("You can't open this site directly");
	}
	include "../config/mssql.conf.php";
	if ($_GET['do1'] == "edit"){
	mssql_query("UPDATE osds.dbo.site_about SET content = '".$_POST['content']."' WHERE sid = '".$_POST['sid']."'");
	echo '<center><strong>The about page has been edited!</strong></center>';
	}
	echo '<table align="center" cellspacing="0" cellpadding="0">
	<tr>
	<td>';
	$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
	$query = mssql_query("SELECT * FROM osds.dbo.site_about",$ms_con);
	while($r = mssql_fetch_array($query)){
	echo "<form method='post' action='?do=about&id=".$id."&do1=edit'><table width='430' align='center'>
	<tr><td>
	You cant use any html tags,
but you can use the following BBCodes:<br><br>

<table width='422' border='0'>
  <tr>
    <td><img src='images/bbcode/align_center.png'/></td>
    <td>[center][/center]</td>
  </tr>
  <tr>
    <td><img src='images/bbcode/bold.png'/></td>
    <td>[b][/b]</td>
  </tr>
    <tr>
    <td><img src='images/bbcode/link.png'/></td>
    <td>[url=the-address]Name of like[/url]</td>
  </tr>
  <tr>
    <td><img src='images/bbcode/underline.png'/></td>
    <td>[u][/u]</td>
  </tr>
    <tr>
    <td><img src='images/bbcode/italic.png'/></td>
    <td>[i][/i]</td>
  </tr>
</table>	

	<br /><br /><input type='hidden' name='sid' value='".$r['sid']."' />
	<textarea cols='75' rows='25' name='content' class='opera'>".$r['content']."</textarea><br />
	<input type='submit' value='Edit' /></center></td></tr>
	</table></form>";
	}
	
	echo "</td>
	</tr>
	</table><br />";
?>