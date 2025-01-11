<?php
flush_this();
$mssql_query = $db->SQLquery("SELECT SERVERPROPERTY('productversion'), SERVERPROPERTY('productlevel'), SERVERPROPERTY('edition')");
$mssql_info = $db->SQLfetchArray($mssql_query);
?>        
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Webserver Info</td>
	</tr>
	<tr>
		<td align="left" class="panel_title_sub" colspan="2">PHP</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top">Current php version</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo PHP_VERSION; ?></td>
	</tr>
		<td align="left" class="panel_title_sub" colspan="2">Server</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top">Server software & modules</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
	</tr>
	<tr>
		<td align="left" class="panel_title_sub" colspan="2">Memory</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top">Current memory usage / Server memory limit</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo convertbytes(memory_get_usage(true)); ?> / <?php echo ini_get( "memory_limit" ); ?>b</td>
	</tr>
  	<tr>
		<td align="left" class="panel_title_sub" colspan="2">Error Reporting</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top">Current level of error reporting</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo ini_get('display_errors'); ?></td>
	</tr>
</table>
<?php echo flush_this(); ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
	<tr>
		<td align="center" class="panel_title" colspan="2">MsSQL Info</td>
	</tr>
	<tr>
		<td align="left" class="panel_title_sub" colspan="2">Product version</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top">Current mssql version</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $mssql_info[0]; ?></b></td>
	</tr>
		<td align="left" class="panel_title_sub" colspan="2">Service Pack</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top">Current service pack</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $mssql_info[1]; ?></td>
	</tr>
	<tr>
		<td align="left" class="panel_title_sub" colspan="2">MsSQL edition</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top">Type of mssql server edition</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $mssql_info[2]; ?></td>
	</tr>
</table>
<?php echo flush_this(); ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
	<tr>
		<td align="center" class="panel_title" colspan="2">Server Info</td>
	</tr>
    <tr>
		<td align="left" class="panel_title_sub" colspan="2">Time / Date</td>
	</tr>
	<tr>
		<td align="left" class="panel_text_alt1" width="45%" valign="top">Current Time + date + timezone</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo date(DATE_RFC822); ?></td>
	</tr>
</table>