<?php
if (!@$_SESSION['AUCTION_ACTION_CHARACTER_NO'])
{
	echo '<br><br><center><b>Sorry, you didnt select a auction character.</b><br><a href="auction.php?action=set_character">Click here</a> to select a character.</center><br><br>';	
}
else
{

	include 'items.php';
	include 'do_not_auction_this.php';
	
	
	$query1 = $dekaron->SQLquery("SELECT line_no,wIndex,character_no FROM user_store WHERE character_no = '".$_SESSION['AUCTION_ACTION_CHARACTER_NO']."' ");
	$query2 = $dekaron->SQLquery("SELECT line_no,wIndex,character_no FROM user_storage WHERE character_no = '".$_SESSION['AUCTION_ACTION_CHARACTER_NO']."' ");
	$query3 = $dekaron->SQLquery("SELECT line_no,wIndex,character_no FROM user_bag WHERE character_no = '".$_SESSION['AUCTION_ACTION_CHARACTER_NO']."' ");
	echo '<h2>Items from '.$_SESSION['AUCTION_ACTION_CHARACTER_NAME'].'</h2>';		
		echo '<table width="100%" align="center" >';
			echo '<tr valign="top">';
				echo '<td width="33%">';
			
					echo '<table width="100%">';
					echo "<tr>";
						echo "<th align='center'>Store Items</th>";
					echo "</tr>";
					
					while($getAuction = $dekaron->SQLfetchArray($query1))
					{
						if (in_array($getAuction['wIndex'], $not_allowed_to_auction))
						{
							// dont show item
							continue;
						}
						else
						{
							echo "<tr>";
								echo '<td align="left">';
									echo "<a href='auction.php?action=auction_item&item=".$getAuction['wIndex']."&line_no=".$getAuction['line_no']."&item_name=".base64_encode($items[$getAuction['wIndex']])."&source=user_store'>".$items[$getAuction['wIndex']]."</a>";
								echo '</td>';
							echo "</tr>";
						}
					}
					echo '</table>';
				
				echo '</td>';
				echo '<td width="33%">';
				
				
					echo '<table width="100%">';
					echo "<tr>";
						echo "<th align='center'>Storage Items</th>";
					echo "</tr>";
					
					while($getAuction = $dekaron->SQLfetchArray($query2))
					{
						if (in_array($getAuction['wIndex'], $not_allowed_to_auction))
						{
							// dont show item
							continue;
						}
						else
						{
							echo "<tr>";
								echo '<td align="left">';
									echo "<a href='auction.php?action=auction_item&item=".$getAuction['wIndex']."&line_no=".$getAuction['line_no']."&item_name=".base64_encode($items[$getAuction['wIndex']])."&source=user_storage'>".$items[$getAuction['wIndex']]."</a>";
								echo '</td>';
							echo "</tr>";
						}
					}
					echo '</table>';
		
				
				echo '</td>';
				echo '<td width="34%">';
				
				
					echo '<table width="100%">';
					echo "<tr>";
						echo "<th align='center'>Inventory Items</th>";
					echo "</tr>";
					
					while($getAuction = $dekaron->SQLfetchArray($query3))
					{
						if (in_array($getAuction['wIndex'], $not_allowed_to_auction))
						{
							// dont show item
							continue;
						}
						else
						{
							echo "<tr>";
								echo '<td align="left">';
									echo "<a href='auction.php?action=auction_item&item=".$getAuction['wIndex']."&line_no=".$getAuction['line_no']."&item_name=".base64_encode($items[$getAuction['wIndex']])."&source=user_bag'>".$items[$getAuction['wIndex']]."</a>";
								echo '</td>';
							echo "</tr>";
						}
					}
					echo '</table>';
		
				
				echo '</td>';
			echo '<tr>';
		echo '</table>';
		echo '<br>';
}
?>