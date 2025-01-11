<?php
if(ALLOW_OPEN != 1 && ALLOW_OPEN != 2) {
Header('HTTP/1.1 403');
exit(0);
}
echo '<table><tr><td class=header>Client Download</td></tr>';
	
	$query = mssql_query("SELECT * FROM osds.dbo.site_download ORDER by sid ASC");
	
	while($r = mssql_fetch_array($query)){
	$descr = $r['descr'];
	$link = $r['link'];
	echo '
	<tr><td>',$r['name'],'</td></tr>
	<tr><td>Version: ',$r['version'],'</td></tr>
	<tr><td>',$descr,'</td></tr>
	<tr><td style="border-bottom:1px solid white"><a href=http://',$link,' target=_blank>Download</a></td></tr>';
	}
echo '</table>';
?>