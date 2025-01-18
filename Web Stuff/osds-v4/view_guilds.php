<?php include "header.php"; 

// -----------------------------------
// Get all info
// -----------------------------------
$query1 = $db->query('SELECT * FROM character.dbo.guild_info');  

// -----------------------------------
// Start HTML
// -----------------------------------
echo '
<article>
	<h1>Guilds</h1>
	<table class="gtable sortable">
		<tr>
			<td>Guild Name</td>
			<td>Guild Level</td>
			<td>Guild Money</td>
			<td>Guild Adv</td>
			<td>Guild Mark</td>
		</tr>
		<tbody>';
	
	while($getGuildDB = $db->fetchArray($query1))
	{
	
		// Remove the mastercode becuz it should never be edited!		
		if ($getGuildDB['guild_code'] == 'MASTERCODE') {
			continue;
		}
		echo '
			<tr> 
				<td><a href="edit_guild.php?guild=' . $getGuildDB['guild_code'] . '">' . $getGuildDB['guild_name'] . '</a></td>
				<td>' . $getGuildDB['guild_Level'] . '</td>
				<td>' . $getGuildDB['guild_Dil'] . '</td>
				<td>' . $getGuildDB['guild_adv'] . '</td>
				<td><img src="emblem/emblem.php?cbg=' . $getGuildDB['guild_mark2'] . '&cemblem=' . $getGuildDB['guild_mark1'] . '" valign="middle" hight="30" width="30"></td>
			</tr>';
	}
	echo '
    		</tbody>
    	</table>
    </form>
</article>
<div class="warning msg">MASTERCODE has been removed from the list. It should never be edited!</div>';
	
include "footer.php"; 
?>

