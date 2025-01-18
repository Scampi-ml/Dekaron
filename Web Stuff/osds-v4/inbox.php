<?php 
include "header.php";

// -----------------------------------
// Get the user no
// ----------------------------------- 
$query = $db->query('SELECT * FROM account.dbo.inbox WHERE user_no = ' . $_SESSION['user_no'] . ' ');
$getInboxDataNum = $db->fetchNum($query);

// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article>
	<h1>Inbox</h1>
		<table class="gtable sortable">
			<thead>
				<tr>
					<th align="left">From</th>
					<th align="left">Subject</th>
					<th align="right">Date</th>
				</tr>
			</thead>
			<tbody>';
			
			if ($getInboxDataNum < 0)
			{
				echo "<tr><td>No messages for you :( </td></tr>";
			
			} else {
			
				while ( $getInboxData = $db->fetchArray($query) )
				{
					$query2 = $db->query('SELECT * FROM account.dbo.user_profile WHERE user_no = "' . $getInboxData['from_user_no'] . '" ');
					$getInboxDataName = $db->fetchArray($query2);
					
					if ($getInboxData['viewed'] == 0)
					{
						echo '
						<tr style="cursor: pointer;" onclick="document.location=&#39;view_message.php?id=' . $getInboxData['id'] . '&#39;" >
							<td><b>' . $getInboxDataName['user_id'] . '</b></td>';
							
								if(strlen($getInboxData['subject']) > 33)
								{
									echo '<td><b>' . shortText($getInboxData['subject']) . '</b></td>';
								
								} else {
								
									echo '<td><b>' . $getInboxData['subject'] . '</b></td>';
								}
									
								echo '	
							
							<td align="right"><b>' . $getInboxData['inbox_time'] . '</b></td>
						</tr>';
						
					} else {
					
						echo '
						<tr style="cursor: pointer;" onclick="document.location=&#39;view_message.php?id=' . $getInboxData['id'] . '&#39;">
							<td>' . $getInboxDataName['user_id'] . '</td>';
							
								if(strlen($getInboxData['subject']) > 33)
								{
									echo '<td>' . shortText($getInboxData['subject']) . '</td>';
								
								} else {
								
									echo '<td>' . $getInboxData['subject'] . '</td>';
								}
									
								echo '	
									
							<td align="right">' . $getInboxData['inbox_time'] . '</td>
						</tr>';
					}
				}
			}
echo'			
			</tbody>
		</table>
		<br><br>
		<div class="tablefooter clearfix">
			<div class="actions">
				<button class="button small" onclick="document.location=&#39;inbox.php&#39;">Check Messages</button>  
				<button class="button small" onclick="document.location=&#39;create_message.php&#39;">Create New</button>
			</div>
		</div>
</article>';

include "footer.php";
?>
