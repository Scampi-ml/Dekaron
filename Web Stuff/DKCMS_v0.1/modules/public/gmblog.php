<?php 

echo '
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody>
	    <tr>
	        <td width="64">
	            <span style="float: left;">
	            <img src="'.$styledir.'/images/gm_title.gif" border="0" /></span>
		    </td>
	    </tr>

	    <tr>
	        <td height="4"></td>
	    </tr>

	    <tr>
	        <td colspan="3" style="background-color:#b8b8b8;" height="3"></td>
	    </tr>
	    <tr>
	         <td height="4"></td>
	    </tr>
	';

if(@$_GET['id']){
	$id = $_GET['id'];
	$gb = mssql_query("SELECT * FROM dkcms.dbo.dkcms_gmblog WHERE id='".$id."'");
	$b = mssql_fetch_array($gb);
	echo "
		<tr>
			<td align=right class='nebcolor' style='padding: 4px;' valign='top'>
				[".$b['date']."]
			</td>
			<td align=left class='nebcolor' style='padding: 4px;'>
				[".$b['author']."] <b>".$b['title']."</b><br />";

	echo ''.$b['content'].'<br /><br />';
	echo "</td>
			<td align='right' valign='top' class='nebcolor' style='padding: 4px;' />
		</tr>";
}else{
	$gb = mssql_query("SELECT * FROM dkcms.dbo.dkcms_gmblog ORDER BY id DESC");


	$rows = mssql_num_rows($gb);

	if ($rows < 1) {
		echo "
		<tr>
			<td colspan='3'>There are currently no blogs.</td>
		</tr>
		";
	}
}
echo "</tbody>
</table>";

?>