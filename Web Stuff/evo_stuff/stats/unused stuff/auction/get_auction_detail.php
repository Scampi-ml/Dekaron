<?php
if (!@$_SESSION['NICKNAME'])
{
	echo '<br><br><center><b>Sorry, you didnt select a auction character.</b><br><a href="auction.php?action=set_character">Click here</a> to select a character.</center><br><br>';	
}
else
{
	$query1 = $dekaron->SQLquery("SELECT * FROM auction.dbo.auction_products WHERE product_id = '".$_GET['auction']."'");
	$getAuctionDetail = $dekaron->SQLfetchArray($query1);
	
	$query2 = $dekaron->SQLquery("SELECT * FROM auction.dbo.items WHERE Id = '".$getAuctionDetail['item_index']."' ");
	$getItemDetail = $dekaron->SQLfetchArray($query2);
	
	$query4 = $dekaron->SQLquery("SELECT * FROM auction.dbo.auction_bids WHERE product_id = '".$_GET['auction']."' ORDER BY time_of_bid DESC");
	$getAuctionBid = $dekaron->SQLfetchArray($query4);
	$getAuctionBidNum = $dekaron->SQLfetchNum($query4);
	
	$job = array(
	   '1000-0000-0000-0000-0000-0000-0000-0000' => "Azure Knight",
	   '0100-0000-0000-0000-0000-0000-0000-0000' => "Segita Hunter",
	   '0010-0000-0000-0000-0000-0000-0000-0000' => "Incar Magician",
	   '0001-0000-0000-0000-0000-0000-0000-0000' => "Vicious Summoner",
	   '0000-1000-0000-0000-0000-0000-0000-0000' => "Segnale",
	   '0000-0100-0000-0000-0000-0000-0000-0000' => "Bagi Warrior"
	);
	
	if ($getAuctionDetail['closing_date'] < time())
	{
		echo '<br><br><center><b>Sorry, this auction has ended.</b><br><a href="auction.php?action=get_auctions">Click here</a> to view more auctions.</center><br><br>';	
	}
	else
	{
	?>
		<h2><?php echo $getAuctionDetail['product_name']; ?> - <?php echo $getAuctionDetail['item_index']; ?></h2>     
		</div>
		<div class="clear"></div>
		<div class="grid_2">
			<table width="100%" border="0" cellpadding="1" cellspacing="1">
				<tr>
					<td>Time Left</td>
					<td align="right">
						<?php
						if ($getAuctionDetail['closing_date'] < time())
						{
							echo 'Ended!';
						}
						else
						{
							$diff = $getAuctionDetail['closing_date'] - time();
							echo $dekaron->convertTime($diff);
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Category</td>
					<td align="right"><?php echo $getAuctionDetail['product_categories']; ?></td>
				</tr>
				<tr>
					<td>Class</td>
					<td align="right">
						<?php
						if($getItemDetail['Job'] == NULL)
						{
							echo 'N/A or any class';
						}
						else
						{
							echo $job[$getItemDetail['Job']];
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Required Level</td>
					<td align="right">
						<?php
						if( $getItemDetail['ReqLv'] == NULL)
						{
							echo "No level required";
						}
						else
						{
							echo $getItemDetail['ReqLv'];
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Required Space (Width)</td>
					<td align="right">
						<?php
						if( $getItemDetail['Width'] == NULL)
						{
							echo "N/A";
						}
						else
						{
							echo $getItemDetail['Width'];
						}
						?>
					</td>
				</tr>
				<tr>
					<td>Required Space (Height)</td>
					<td align="right">
						<?php
							if( $getItemDetail['Height'] == NULL)
							{
								echo "N/A";
							}
							else
							{
								echo $getItemDetail['Height'];
							}
						?>
					</td>
				</tr>
			</table>
		</div>
		<div class="grid_2"></div>
		<div class="clear"></div>
		<hr />
		<div class="message info">
			<center>
				<form action="auction.php?action=place_bid" method="post">
					<?php
					if($getAuctionBidNum == 0)
					{
						$next_bid = $getAuctionDetail['minimum_bid'] + 1;
					}
					else
					{
						$query6 = $dekaron->SQLquery("SELECT max(bid_amount) FROM auction_bids WHERE product_id = '".$_GET['auction']."' ");
						$getAuctionBids = $dekaron->SQLfetchArray($query6);
						$next_bid =  $getAuctionBid['bid_amount'] + 1;
					}
					?>
					<input type="text" name="bid" value="<?php echo $next_bid; ?>" maxlength="9" size="20" style="margin-top: 5px;">
					<br>
					You need to bid <?php echo $next_bid; ?> or more
					<input type="hidden" name="auction" value="<?php echo $_GET['auction']; ?>">
				<br><br>
				<button type="submit" class="button button-gray">Place Bid</button>
				<?php 
				if ($getAuctionDetail['buyout_price'] != '')
				{
					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; or &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="submit" class="button button-gray">Buy it now!</button>';
				}
				?>
				</form>
			</center>
		</div>
		<hr />
		<h2>Bids</h2>     
		<?php
		if ($getAuctionBidNum == 0)
		{
			echo '<br><br><center><b>No bids, be the first!</b></center><br><br>';					
		}
		else
		{
			echo '<table class="datatable paginate sortable full" align="center">';
				echo '<thead>';
					echo '<tr>';
						echo '<th>Bidder</th>';
						echo '<th>Bid</th>';
						echo '<th>Time</th>';
					echo '</tr>';
				echo '</thead>';
			echo '<tbody>';
				$query5 = $dekaron->SQLquery("SELECT * FROM auction_bids WHERE product_id = '".$_GET['auction']."' ORDER BY time_of_bid DESC");
	
				while ( $getAuctionBids2 = $dekaron->SQLfetchArray($query5) )
				{
					echo '<tr>';
						echo '<td>'.$getAuctionBids2['username'].'</td>';
						echo '<td>'.$getAuctionBids2['bid_amount'].'</td>';	
						echo '<td>'.$dekaron->timeago(date("r",$getAuctionBids2['time_of_bid'])).'</td>';	
					echo '</tr>';
				}
				echo '</tbody>';
			echo '</table>';
		}
	}
}
?>