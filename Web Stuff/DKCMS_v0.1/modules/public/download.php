<?php
// need to be fixed
//$styledir = "styles/dkcms/";
//-----------------

echo '
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="64">
			<span style="float: left;">
	            <img src="'.$styledir.'/images/download_title.gif" alt="Event" border="0" />
			</span>
		</td>
	</tr>
</table>';

$i = 0;
		$query = mssql_query("SELECT * FROM dkcms.dbo.dkcms_download ORDER BY id ASC");
			echo '';
	while ($row = mssql_fetch_row($query)) 
	
	{

echo'			<table width="538" style="background:url('.$styledir.'/images/download_border.gif) no-repeat;" border="0" cellpadding="0" cellspacing="0">
					<tbody>
						<tr>
							<td valign="top">
								<div style="margin-top: 32px; margin-left: 230px;">
									<b>'.$row[2].'</b><br />
								</div>
							</td>
							<td valign="top" align="right" height="108">
								<div style="margin-top: 16px; margin-right: 26px;">

									<a href="'.$row[1].'">
									<img src="'.$styledir.'/images/download_site.gif" alt="Download" border="0" />
									</a>
								</div>
							</td>
						</tr>
					</tbody>
				</table>';
			$i++;
	}
	
if($i == 0) {
echo '
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="64">
			<span style="float: left;">
	            <img src="'.$styledir.'/images/download_title.gif" alt="Event" border="0" />
			</span>
		</td>
	</tr>
	<tr><td align="center">There are currently no downloads.</td></tr>";
</table>';
}
?>