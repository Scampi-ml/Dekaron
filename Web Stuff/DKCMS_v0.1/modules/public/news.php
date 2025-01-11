<?php 
echo '
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody>
	    <tr>
	        <td width="64">
	            <span style="float: left;">
	            <img src="'.$styledir.'/images/notice_title.gif" border="0" /></span>
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

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$gn = mssql_query("SELECT * FROM dkcms.dbo.dkcms_news WHERE id='".$id."'");
	$n = mssql_fetch_array($gn);
	echo "
		<tr>
			<td class='nebcolor' align='left' valign='top' style='padding: 4px;'>
				<img src='images/".$n['type'].".gif' alt='".$n['type']."' />
			</td>
			<td align='left' class='nebcolor' style='padding: 4px;'>
				[".$n['date']."] <b>".$n['title']."</b> - Posted by 
				<b><a href='?dkcms=main&amp;page=members&amp;name=".$n['author']."'>".$n['author']."</a></b><br />";
	echo nl2br(stripslashes($n['content']))."
				<br /><br />";

	echo "
			</td>
			<td align='right' valign='top' class='nebcolor' style='padding: 4px;'>";
	if(isset($_SESSION['admin'])){
		echo "
				<a href='?dkcms=admin&amp;page=mannews&amp;action=edit&amp;id=".$n['id']."'>Edit</a> | 
				<a href='?dkcms=admin&amp;page=mannews&amp;action=del'>Delete</a>";
	}
	echo "
			</td>
		</tr>";
}else{
	$gn = mssql_query("SELECT * FROM dkcms.dbo.dkcms_news ORDER BY id DESC");

	$rows = mssql_num_rows($gn);

	if ($rows < 1) {
		echo "
		<tr>
			<td colspan='3'>There are currently no news.</td>
		</tr>
		";
	}

	while($n = mssql_fetch_array($gn)){
		$gc = mssql_query("SELECT * FROM dkcms.dbo.dkcms_news WHERE id='".$n['id']."' ORDER BY id ASC");
		$cc = mssql_num_rows($gc);
		echo "
		<tr>
			<td align='left' valign='top' class='nebcolor' style='padding: 4px;'>
				<img src='images/".$n['type'].".gif' alt='".$n['type']."' />
			</td>
			<td align='left'  class='nebcolor' style='padding: 4px;'>
				[".$n['date']."] <b><a href='?dkcms=main&page=news&amp;id=".$n['id']."'>".$n['title']."</a></b>
			</td>
			<td align='right' class='nebcolor' style='padding: 4px;'>";
		if(isset($_SESSION['admin'])){
			echo "
				<a href='?dkcms=admin&amp;page=mannews&amp;action=edit&amp;id=".$n['id']."'>Edit</a> | 
				<a href='?dkcms=admin&amp;page=mannews&amp;action=del'>Delete</a>";
		}
		echo "
			</td>
		</tr>";
	}
}
echo "
      </tbody>
</table>";
?>