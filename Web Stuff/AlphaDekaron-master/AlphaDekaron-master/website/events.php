<?php
include_once("config\conf.php");
$query = mssql_query("SELECT * FROM osds.dbo.event where eEnd>getdate() ORDER by eStart ASC");
echo '<html><link href=config/alphanew.css type=text/css rel=stylesheet><table><tr><td class=header>Events</td></tr>';
$count = mssql_num_rows($query);
if ($count > 0)
{
	while($r = mssql_fetch_row($query))
	{
		echo '<tr><td><span class=newscontent>'.html_entity_decode(htmlspecialchars($r[1])).'</span>
		<br><i>Hosted by ',$r[2],' ';
		if((date("n/j/o g:i A",strtotime($r[3]))<=date("n/j/o g:i A"))&&(date("n/j/o g:i A",strtotime($r[4]))>=date("n/j/o g:i A")))
		{
		echo '<b>RIGHT NOW!</b>';
		}
		else
		{
		echo 'during ',$r[3],' - ',$r[4],' (GMT-5)';
		}
		echo'</i><br>',html_entity_decode(htmlspecialchars($r[5])),'<br><br></td></tr>';
	}
}	
else
{
	echo '<tr><td class=news>No upcoming events posted.</td></tr>';
}
echo '</table></html>';
?>
