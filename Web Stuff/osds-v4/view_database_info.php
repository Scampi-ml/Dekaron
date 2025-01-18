<?php
include "header.php";

// -----------------------------------
// Get the DB info
// -----------------------------------
$database_info = $db->query('SELECT * FROM master.dbo.sysdatabases');
$dbsNum = $db->fetchNum($database_info);

// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article>
	<h1>Database Info</h1>
		<table class="gtable sortable">
			<thead>
				<tr>
					<th>Database Name</th>
					<th>Size</th>
					<th align="right">Status</th>
				</tr>
			</thead>
			<tbody>';
			
			if ($dbsNum == 0)
			{
				echo "<tr><td>No datbases found????</td></tr>";
			
			} else {
			
				while ($dbs = $db->fetchArray($database_info))
				{
						echo '
						<tr>
							<td>' . $dbs['name'] . '</td>
							<td>' . format_bytes(filesize($dbs['filename'])). '</td>
							<td align="right">' . $dbs['status']. '</td>

						</tr>';
				}
			}
echo'			
			</tbody>
		</table>
		<div class="clear"></div>
</article>
<div class="information msg">Total Databases: <strong>' . $dbsNum . '</strong> </div>
<div class="information msg"><a href="http://msdn.microsoft.com/en-us/library/aa260406%28v=sql.80%29.aspx">More Info about statuses</a></div>';


include "footer.php";
?>
