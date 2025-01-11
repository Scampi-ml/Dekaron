<?php
if(ALLOW_OPEN != 1 && ALLOW_OPEN != 2) {
Header('HTTP/1.1 403');
exit(0);
}
$query = mssql_query("SELECT TOP 5 * FROM osds.dbo.site_news ORDER by sid DESC");
echo '<table><tr><td class=header>Latest News</td></tr>';
$count = mssql_num_rows($query);
if ($count > 0)
{
	while($r = mssql_fetch_row($query))
	{
		echo '<tr><td><span class=newscontent>'.html_entity_decode(htmlspecialchars($r[1])).'</span>
		<br><i>Written by '.$r[2].' at '.$r[3].'</i><br>'.html_entity_decode(htmlspecialchars($r[4])).'<br><br></td></tr>';
	}
}	
else
{
	echo '<tr><td class=news>No news has been posted.</td></tr>';
}
echo '</table>';
?>