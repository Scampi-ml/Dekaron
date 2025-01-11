<?php 

echo '
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="64">
			<span style="float: left;">
	            <img src="'.$styledir.'/images/event_title.gif" alt="Event" border="0" />
			</span>
		</td>
	</tr>
	<tr>
		<td height="4" />
	</tr>
	<tr>
		<td colspan="3" style="background-color:#b8b8b8;" height="3"></td>
	</tr>
	<tr>
		<td height="4" />
	</tr>';
	
if(@$_GET['id']){
	$id = $_GET['id'];
	$ge = mssql_query("SELECT * FROM dkcms.dbo.dkcms_events WHERE id='".$id."'");
	$e = mssql_fetch_array($ge);
	echo "
	<tr>
		<td align='left' class='nebcolor' style='padding: 4px;' valign='top'>
			<img src='images/".$e['type'].".gif' alt='' />
		</td>";
	echo "
		<td align='left' class='nebcolor' style='padding: 4px;'>
			[".$e['date']."] <b>".$e['title']."</b> - Posted by 
			<b>".$e['author']."</b><br />";
	if($e['status'] == "Active"){
		$status = "
			<font color='green'>Active</font>";
	}elseif($e['status'] == "Standby"){
		$status = "
			<font color='orange'>Standby</font>";
	}elseif($e['status'] == "Ended"){
		$status = "
			<font color='red'>Ended</font>";
	}
	echo "
			<b>Event Status: ".$status."</b>
			<br /><br />";
	echo "'".$e['content']."
			<br /><br />";

	echo "
		</td>
		<td align='right' valign='top' class='nebcolor' style='padding: 4;'>";
	if(isset($_SESSION['admin'])){
		echo "
			<a href='?dkcms=admin&amp;page=manevent&amp;action=edit&amp;id=".$e['id']."'>Edit</a> | 
			<a href='?dkcms=admin&amp;page=manevent&amp;action=del'>Delete</a>";
	}
	echo "
		</td>
	</tr>";
}else{
	$ge = mssql_query("SELECT * FROM dkcms.dbo.dkcms_events ORDER BY id DESC");

	$rows = mssql_num_rows($ge);

	if ($rows < 1) {
		echo "
		<tr>
			<td colspan='3'>There are currently no events.</td>
		</tr>
		";
	}


	while($e = mssql_fetch_array($ge)){
		echo "
	<tr>
		<td align='left' class='nebcolor' style='padding: 4px;'>
			<img src='images/".$e['type'].".gif' alt='' />
		</td>";
		echo "
		<td align='left' class='nebcolor' style='padding: 4px;'>
			[".$e['date']."]  
			<b><a href='?dkcms=main&amp;page=events&amp;id=".$e['id']."'>".$e['title']."</a></b>
		</td>
		<td align='right' class='nebcolor' style='padding: 4px;'>";
		if(isset($_SESSION['admin'])){
			echo "<a href='?dkcms=eventadmin&amp;action=edit&amp;id=".$e['id']."'>Edit</a> | <a href='?dkcms=eventadmin&amp;action=del'>Delete</a>";
		}
		echo "
		</td>
	</tr>";
	}
}
echo '
	<tr>
		<td height="4" />
	</tr>
</table>';

?>